<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Folder;
use App\Models\MyFile;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // return $user = auth()->user();
        
        //Storage::disk('public')->move('tests/old.jpg', 'tests/new.jpg'); //rename file
        
        //rename folder
        // $old = Storage::disk('public')->path('old');
        // rename($old, 'C:\xampp\htdocs\filemanager\filemanager\storage\app/public\new');

        return view('landing');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Auth::login($user);

        // Alert::success('Welcome to SmartFM', '');
        return redirect()->route('dashboard');
    }

    public function loginPost(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $userCheck = User::where('email', $data['email']);

        if ($userCheck->count() < 1) {
            // Alert::error('User does not Exist', '');
            return back();
        }
        $user = $userCheck->first();

        $passCheck = Hash::check($data['password'], $user->password); //bool true or false

        if (($userCheck->count() > 0) && ($passCheck)) {
            Auth::login($user);
            // Alert::success('Logged In Successfully', '');
            return redirect()->route('dashboard');
            //return redirect()->intended('/admin')->withSuccess('Signed in');
        }


        return redirect("admin/login")->withError('Login details are not valid');
    }

    //create folder in folder
    public function createfolder(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => 'required',
        ]);
        $data = $request->all();

        //main folder
        if (empty($data['item_id'])) {
            $parentFolder = Folder::where(['created_by'=>$user->id, 'title'=>'Main'])->first();
        } else {
            //sub-folder
            $parentFolder = Folder::find($data['item_id']);
        }

        $slug = Str::slug($data['title']);
        $slugPath = $parentFolder->path_by_slug.'/'.$slug;
        $titlePath = $parentFolder->path_by_title.'/'.$data['title'];

        Storage::disk('public')->makeDirectory($slugPath);

        $folder = new Folder();
        $folder->unique_key = Str::random(30);
        $folder->title = $data['title'];
        $folder->slug = $slug;
        $folder->created_by = $user->id;
        $folder->parent_id = $parentFolder->id;
        $folder->path_by_slug = $slugPath;
        $folder->path_by_title = $titlePath;
        $folder->save();
        return back();

    }

    //rename folder
    public function renameFolder(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => 'required',
        ]);
        $data = $request->all();

        $folder = Folder::find($data['item_id']);
        $parentFolder = Folder::where('id', $folder->parent_id)->first();
        $titlePath = $parentFolder->path_by_title.'/'.$data['title'];
        $folder->title = $data['title'];
        $folder->path_by_title = $titlePath;
        $folder->save();

        return back();
    }

    public function renameFile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => 'required',
        ]);
        $data = $request->all();

        $myFile = MyFile::find($data['item_id']);
        $type = (string) $myFile->type; //'jpg'

        $folderPath = (string) $myFile->folder->path_by_slug; //'ugo-sunday-2', img location
        $oldFileTitle = (string) $myFile->title;
        $oldPath = $folderPath.'/'.$oldFileTitle; //'ugo-sunday-2/165346088123232-323329_fashion-.....png'

        $newFileTitle = (string) $data['title'];
        $newPath = $folderPath.'/'.$newFileTitle.'.'.$type; //'ugo-sunday-2/lady.jpg'

        //name in storage
        Storage::disk('public')->move($oldPath, $newPath);

        $new_title = $data['title'].'.'.$myFile->type; //;lady.jpg

        //update file
        $myFile->title = $new_title;
        $myFile->original_name = $data['title'];
        $myFile->save();

        return back();



    }

    public function downloadFile($id)
    {
        $file_id = $id;
        $file = MyFile::find($file_id);
        $fileTitle = (string) $file->title;
        $folderPath = (string) $file->folder->path_by_slug;
        $filePath = $folderPath.'/'.$fileTitle;

        $filePathToDownload = Storage::disk('public')->path($filePath);
        // $filex= storage_path()."app/ugo-sunday-2/'.$fileTitle";
        // if (file_exists($filex)) {
        //     $headers = [
        //         'Content-Type' => 'application/png',
        //     ];
        //     return response()->download($filex, "{$fileTitle}", $headers);
        // }
        $type = $file->type;
        $newFileName = isset($file->original_name) ? $file->original_name.'.'.$type : 'sfm-item'.'.'.$type;

        $headers = ['Content-Type: application/'.$type];
        return response()->download($filePathToDownload, $newFileName, $headers);

        
    }

    //deleteFile
    public function deleteFile($id)
    {
        $file = MyFile::find($id);
        $file_title_with_extension = (string) $file->title; //xyz.jpg
        $folderPath = (string) $file->folder->path_by_slug; // x/y

        $filePath = $folderPath.'/'.$file_title_with_extension; // x/y/xyz.jpg

        Storage::disk('public')->delete($filePath);
        $file->delete();
        return back()->with('success','File deleted successfully');
    }

    //all user folders and files
    public function uploads()
    {
        $base_url = url('/'); //http://127.0.0.1:8000
        $user = auth()->user();
        $user_main_folder = Folder::where(['created_by'=>$user->id, 'parent_id'=>NULL])->first();

        $folders = $user_main_folder->folders;
        $files = $user->myFiles()->where('folder_id', $user_main_folder->id)->get();

        //merger array, sort by latest
        $collection = collect([$folders, $files]);
        $mergedItems = $collection->collapse();
        $mergedItems = $mergedItems->SortByDesc('created_at');

        $extensionArray = ['jpeg', 'jpg', 'png', 'gif', 'pdf', 'xlx', 'docs'];

        return view('uploads', compact('mergedItems', 'extensionArray', 'base_url'));
    }

    public function singleFolder($id)
    {
        $folder = Folder::find($id);
        $subfolders = $folder->folders;
        $files = $folder->myFiles;

        $collection = collect([$subfolders, $files]);
        $mergedItems = $collection->collapse();
        $mergedItems = $mergedItems->SortByDesc('created_at');

        $extensionArray = ['jpeg', 'jpg', 'png', 'gif', 'pdf', 'xlx', 'docs'];
        return view('singleFolder', compact('mergedItems', 'folder', 'extensionArray'));  
    }

    //save files from dropzone
    public function uploadsPost(Request $request)
    {
        $user = auth()->user();
        $storePath = $request->input('store_path'); //this is an id value

        //main folder
        if (empty($storePath)) {
            $parentFolder = Folder::where(['created_by'=>$user->id, 'title'=>'Main'])->first();
            $parentPath = $parentFolder->path_by_slug;
        } else {
            //sub-folder
            $parentFolder = Folder::find($storePath);
            $parentPath = $parentFolder->path_by_slug;
        }

        //store in folder
        $file = $request->file('file');
        $extension = $file->extension();
        $size = $file->getSize();
        $fileName = $file->getClientOriginalName();
        $file->storeAs($parentPath, $fileName, 'public');

        //save files
        $myFile = new MyFile();
        $myFile->unique_key = Str::random(30);
        $myFile->title = $fileName;
        $myFile->size = $size;
        $myFile->created_by = $user->id;
        $myFile->type = $extension;
        $myFile->folder_id = $parentFolder->id;
        $myFile->save();

        return response()->json(['success'=>$fileName]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
