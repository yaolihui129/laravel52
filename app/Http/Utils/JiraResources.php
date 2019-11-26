<?php
namespace App\Utils;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use JiraRestApi\JiraException;
use JiraRestApi\Project\ProjectService;
use JiraRestApi\Auth\AuthService;
use Symfony\Component\HttpFoundation\Response;

class JiraResources{

    /**
     * 获取单个项目信息
     * @param $projectIdOrKey
     * @return false|string
     * @throws Exception
     */
    public static function getProjectInfo($projectIdOrKey){
        try{
            $project    = new ProjectService();
            $res        = $project->get($projectIdOrKey);
            return response($res,200);
        }catch (JiraException $e){
            return $e->getMessage();
        }
    }

    /**
     * 获取所有项目
     * @return ResponseFactory|string|Response
     * @throws Exception
     */
    public static function getAllProject(){
        try{
            $project    = new ProjectService();
            $res        = $project->getAllProjects();
            return response($res,200);
        }catch (JiraException $e){
            return $e->getMessage();
        }
    }



}