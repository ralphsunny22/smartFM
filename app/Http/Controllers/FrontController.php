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
        if (empty($data['save_path'])) {
            $parentFolder = Folder::where(['created_by'=>$user->id, 'title'=>'Main'])->first();
        }

        //sub-folder
        $parentFolder = Folder::find($data['save_path']);

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

    //all user folders and files
    public function uploads()
    {
        $user = auth()->user();
        $user_main_folder = Folder::where(['created_by'=>$user->id, 'parent_id'=>NULL])->first();

        $folders = $user_main_folder->folders;
        $files = $user->myFiles;

        //merger array, sort by latest
        $collection = collect([$folders, $files]);
        $mergedItems = $collection->collapse();
        $mergedItems = $mergedItems->SortByDesc('created_at');

        return view('uploads', compact('mergedItems'));
    }

    public function singleFolder($id)
    {
        $folder = Folder::find($id);
        $subfolders = $folder->folders;
        $files = $folder->myFiles;

        $collection = collect([$subfolders, $files]);
        $mergedItems = $collection->collapse();
        $mergedItems = $mergedItems->SortByDesc('created_at');
        return view('singleFolder', compact('mergedItems', 'folder'));  
    }

    //save files from dropzone
    public function uploadsPost(Request $request)
    {
        $user = auth()->user();
        $storePath = $request->input('store_path');

        //main folder
        if (empty($storePath)) {
            $parentFolder = Folder::where(['created_by'=>$user->id, 'title'=>'Main'])->first();
            $parentPath = $parentFolder->path_by_slug;
        }

        //sub-folder
        
        //store in folder
        $file = $request->file('file');
        $extension = $file->extension();
        $fileName = $file->getClientOriginalName();
        $file->storeAs($parentPath, $fileName, 'public');

        //save files
        $myFile = new MyFile();
        $myFile->unique_key = Str::random(30);
        $myFile->title = $fileName;
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
