<?php

namespace Dyb\ApiBundle\Controller\Showcase;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Registration controller.
 *
 */
class DefaultController extends Controller
{
    /**
     * list all users
     *
     * @return void
     *
     * @Route("/list", name="Dyb_Showcase_Default_List")
     * @Template()
     */
    public function listAction()
    {
        $wrapper = $this->get('dyb_api.showcase.wrapper');
        $api_response = $wrapper->doRequest('users');

        $response = new Response(json_encode($api_response->users));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * list all users
     *
     * @return void
     *
     * @Route("/choice", name="Dyb_Showcase_Default_Choice")
     * @Template()
     */
    public function choiceAction()
    {
        $wrapper = $this->get('dyb_api.showcase.wrapper');
        $api_response = $wrapper->doRequest('users');
        $usersArray = array();
        foreach($api_response->users as $user){
            $usersArray[$user->id] = $user->firstname." ".$user->lastname;
        }

        $response = new Response(json_encode($usersArray));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * search by name
     *
     * @return void
     *
     * @Route("/search/{terms}", name="Dyb_Showcase_Default_Search")
     * @Template()
     */
    public function searchByNameAction($terms)
    {
        $wrapper = $this->get('dyb_api.showcase.wrapper');
        $query = "<search>
    <queries>";
        foreach(explode(" ",$terms) as $term){
            $query .= "
        <query>
            <term>".$term."</term>
            <fields>
                <in>name</in>
            </fields>
        </query>";
        }
        $query .= "
    </queries>
    <limits>
        <offset>0</offset>
        <limit>25</limit>
    </limits>
</search>";

        $api_response = $wrapper->doRequest('search', array(), $query, "POST");
        $usersArray = array();
        foreach($api_response->results as $user){
            $usersArray[$user->id] = $user->firstname." ".$user->lastname;
        }

        $response = new Response(json_encode($usersArray));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
