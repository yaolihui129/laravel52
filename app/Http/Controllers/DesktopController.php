<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthMenuService;
use App\Services\DesktopService;
use Illuminate\Support\Facades\Auth;

class DesktopController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request) {
		
		$user = $request->user ();
		$dService = new DesktopService (); // 桌面主题、样式
		$userStyleTheme = $dService->getUserDesktop ( $user->id );
		$osDisplay = $user->intOsDisplay;
		$username = $user->chrUserName;
		if ($osDisplay)
			return view ( "desktop" )->withStyletheme ( $userStyleTheme )->withUsername ( $username )->withOsdisplay ( $osDisplay );
		else
			return view ( "classical" )->withUsername ( $username );
	}
	
	/**
	 * 获取桌面菜单（包括上导航，左导航，桌面菜单）信息
	 *
	 * @return string
	 */
	public function getDesktopMenus(Request $request) {
		$amService = new AuthMenuService (); // 获取菜单信息
		$user = $request->user ();
		$res = $amService->getAllMenusJson ( $user );
		return "{success:1,allmenus:" . json_encode ( $res ) . "}";
	}
	
	/**
	 * 获取菜单信息
	 *
	 * @return string
	 */
	public function getMenus(Request $request) {
		$amService = new AuthMenuService (); // 获取菜单信息
		$user = $request->user ();
		$res = $amService->getAllMenusJson ( $user );
		return "{success:1,allmenus:" . json_encode ( $res ) . "}";
	}
}
