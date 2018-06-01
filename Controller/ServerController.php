<?php

namespace Climberdav\HPLayerBundle\Controller;

use Climberdav\HPLayerBundle\ClimberdavHPLayerBundle;
use Climberdav\HPLayerBundle\Entity\Server;
use Climberdav\HPLayerBundle\Form\ServerType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ServerController
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Controller
 * @Route("/server-hyperplanning")
 */
class ServerController extends BaseController
{
    /**
     * Display all servers
     * @return Response
     * @Route("/", name="climberdav_hp_layer_server_index")
     */
    public function indexAction()
    {
        $servers = $this->getDoctrineManager()
            ->getRepository(Server::class)
            ->findAll();
        $deleteForms = array();
        foreach ($servers as $server) {
            $deleteForms[$server->getId()] = $this->createDeleteForm($server)->createView();
        }
        return $this->render("@ClimberdavHPLayer/Server/index.html.twig", [
            "servers" => $servers,
            "delete_forms" => $deleteForms
        ]);
    }

    /**
     * Creates a new Server entity
     *
     * @param Request $request
     * @return RedirectResponse|Response
     * @Method({"GET", "POST"})
     * @Route("/new", name="climberdav_hp_layer_server_new")
     */
    public function newAction(Request $request)
    {
        $server = new Server();
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrineManager();
            $em->persist($server);
            $em->flush();

            return $this->redirectToRoute("climberdav_hp_layer_server_index");
        }

        return $this->render('@ClimberdavHPLayer/Server/new.html.twig', [
            'server' => $server,
            'form' => $form->createView()
        ]);
    }

    /**
     * Displays a form to edit an existing Server entity.
     *
     * @param Request $request
     * @param Server $server
     * @Method({"GET", "POST"})
     * @return RedirectResponse|Response
     * @Route("/edit/{id}", name="climberdav_hp_layer_server_edit")
     */
    public function editAction(Request $request, Server $server){
        $deleteForm = $this->createDeleteForm($server);
        $editForm = $this->createForm(ServerType::class, $server);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entityManager = $this->getDoctrineManager();
            $entityManager->persist($server);
            $entityManager->flush();

            $message = $this->get('translator')->trans('server.edit_ok', [], 'ClimberdavHPLayer');

            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirectToRoute("climberdav_hp_layer_server_index");
        }

        return $this->render('@ClimberdavHPLayer/Server/edit.html.twig', [
            'server' => $server,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a Server entity.
     *
     * @Method("POST|DELETE")
     * @param Request $request
     * @param Server $server
     * @return RedirectResponse
     * @Route("/{id}", name="climberdav_hp_layer_server_delete")
     */
    public function deleteAction(Request $request, Server $server)
    {
        $form = $this->createDeleteForm($server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($server);
            $entityManager->flush();
        }
        return $this->redirectToRoute("climberdav_hp_layer_server_index");
    }

    /**
     * Creates a form to delete a Lecteur entity.
     *
     * @param Server $server
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Server $server)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl("climberdav_hp_layer_server_delete", array('id' => $server->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @Route("/test/{id}", name="climberdav_hp_layer_server_test")
     */
    public function testAction($id)
    {
        $entityManager = $this->getDoctrineManager();
        $server = $entityManager->getRepository(Server::class)->find($id);
        $client= $server->connect();
        if ($client)
        {
            $server->setFirstDayOfServer(new \DateTime($client->DatePremierJourBase()));
            $server->setVersion($client->version());
            $entityManager->persist($server);
            $entityManager->flush();
            $this->get('session')->getFlashBag()
                ->add('success', $this->get('translator')->trans('flash.tested.ok', [], 'ClimberdavHPLayer'));
        }else{
            $this->get('session')->getFlashBag()
                ->add('success', $this->get('translator')->trans('flash.tested.fail', [], 'ClimberdavHPLayer'));
        }
        return $this->redirect($this->generateUrl('climberdav_hp_layer_server_index'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @Route("/toggle/{id}", name="climberdav_hp_layer_server_toggle")
     */
    public function toggleAction($id)
    {
        $entityManager = $this->getDoctrineManager();
        $server = $entityManager->getRepository(Server::class)->find($id);
        $server->setDisabled(!$server->isDisabled());
        $entityManager->persist($server);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('climberdav_hp_layer_server_index'));
    }
}
