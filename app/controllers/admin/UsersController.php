<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/
namespace admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use User;
use Profile;

class UsersController extends \BaseController {

    /**
     * User Repository
     *
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return View::make('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        
        $user = new User;

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        $user->save();

        if ( $user->id )
        {
            return Redirect::route('admin..users.index');
        }

        return Redirect::route('admin..users.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $profile = $user->profile;
        if (is_null($user))
        {
            return Redirect::route('admin..users.index');
        }

        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $input_profile = null;
        if(isset($input['profile']))
        {
            $input_profile = $input['profile'];
            unset($input['profile']);
        }

        $user = $this->user->find($id);
        $user->email = $input['email']; 
        $user->confirmed = isset($input['confirmed']) ? $input['confirmed'] : false; 
         
        if(isset($input['password']) && $input['password'] != '')
        {    
            $user->password = $input['password'];  
            $user->password_confirmation = $input['password_confirmation'];  
        }

        if($result = $user->updateUniques())
        {
            if( $user->profile()->count() > 0)
            {
                unset($input_profile['cover']);
                $user->profile()->update($input_profile);
            }
            else
            {
                $input_profile['user_id'] = $user->id;
                $profile = Profile::create($input_profile);
            }


            return Redirect::route('admin..users.index');
        }

        return Redirect::route('admin..users.edit', $id)
            ->withInput()
            ->withErrors($user->errors())
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->user->find($id)->delete();

        return Redirect::route('admin..users.index');
    }

}
