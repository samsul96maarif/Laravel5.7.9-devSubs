<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Contact;
use Auth;

// use App\Models\Item;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
  public function __construct()
  {

  }

  public function index()
  {
    return view('tes/item_autocomplete');
  }

  public function loadData(Request $request)
    {
    	if ($request->has('q')) {
    		$cari = $request->q;
    		$data = DB::table('items')
          ->select('id', 'name')
          ->where('name', 'LIKE', '%'.$cari.'%')
          ->where('deleted_at', null)
          ->get();

    		return response()->json($data);
    	}
    }

    function fetch(Request $request)
    {
      $user = Auth::user();
      if ($user->role == 0) {
        $organization = organization::findOrFail($user->organization_id);
        $extend = 'employeMaster';
      } else {
        // code...
        $organization = organization::where('user_id', $user->id)->first();
        $extend = 'userMaster';
      }

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('contacts')
          ->where('name', 'LIKE', "%{$query}%")
          ->where('organization_id', $organization->id)
          ->where('deleted_at', null)
          ->get();

        $output = '<div class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
          $output .= '
          <span class="btn contact-list dropdown-item">'.$row->name.'</span>
          ';
        }
        $output .= '</div>';
        echo $output;
      }

    }

    function fetchItem(Request $request)
    {
      $user = Auth::user();
      if ($user->role == 0) {
        $organization = organization::findOrFail($user->organization_id);
        $extend = 'employeMaster';
      } else {
        // code...
        $organization = organization::where('user_id', $user->id)->first();
        $extend = 'userMaster';
      }

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('items')
        ->where('name', 'LIKE', "%{$query}%")
        ->where('organization_id', $organization->id)
        ->where('deleted_at', null)
        ->get();

        $output = '<div class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
          // tampilan yang ada harganya
          // $output .= '
          // <span class="btn item-list dropdown-item">'.$row->name.' = Rp.'.number_format($row->price,2,",",".").'</span>
          // ';
          $output .= '
          <span class="btn item-list dropdown-item">'.$row->name.'</span>
          ';
        }
        $output .= '</div> <br> <br>';
        echo $output;
      }

    }

    function fetchOrganization(Request $request)
    {

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('organizations')
        ->where('name', 'LIKE', "%{$query}%")
        ->where('deleted_at', null)
        ->get();

        $output = '<div class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
          $output .= '
          <span class="btn contact-list dropdown-item">'.$row->name.'</span>
          ';
        }
        $output .= '</div>';
        echo $output;
      }

    }

    function fetchUser(Request $request)
    {

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('users')
        ->where('name', 'LIKE', "%{$query}%")
        ->where('admin', 0)
        ->where('role', 1)
        ->orWhere('username', 'LIKE', "%{$query}%")
        ->where('admin', 0)
        ->where('role', 1)
        ->get();

        $output = '<div class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
          $output .= '
          <span class="btn contact-list dropdown-item">'.$row->name.'</span>
          ';
        }
        $output .= '</div>';
        echo $output;
      }

    }

    function fetchEmployee(Request $request)
    {

      $user = Auth::user();
      if ($user->role == 0) {
        $organization = organization::findOrFail($user->organization_id);
        $extend = 'employeMaster';
      } else {
        // code...
        $organization = organization::where('user_id', $user->id)->first();
        $extend = 'userMaster';
      }

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('users')
        ->where('name', 'LIKE', "%{$query}%")
        ->where('admin', 0)
        ->where('role', 0)
        ->where('organization_id', $organization->id)
        ->orWhere('username', 'LIKE', "%{$query}%")
        ->where('admin', 0)
        ->where('role', 0)
        ->where('organization_id', $organization->id)
        ->get();

        $output = '<div class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
          $output .= '
          <span class="btn contact-list dropdown-item">'.$row->name.'</span>
          ';
        }
        $output .= '</div>';
        echo $output;
      }

    }
}
