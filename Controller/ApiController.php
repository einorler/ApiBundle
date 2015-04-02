<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CRUD implementation for Api Controller.
 *
 * Abstract class ApiControllerInterface
 *
 * @package ONGR\ApiBundle\Controller
 */
class ApiController extends Controller implements ApiControllerInterface
{
    /**
     * Create operation.
     *
     * @param Request $request
     * @param string  $endpoint
     *
     * @return Response
     */
    public function postAction(Request $request, $endpoint = null)
    {
        return new Response('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Read operation.
     *
     * @param Request $request
     * @param string  $endpoint
     *
     * @return Response
     */
    public function getAction(Request $request, $endpoint = null)
    {
        $service = $this->get($endpoint);
        $response = $service->getResponse($request);

        return $response;
    }

    /**
     * Update operation.
     *
     * @param Request $request
     * @param string  $endpoint
     *
     * @return Response
     */
    public function putAction(Request $request, $endpoint = null)
    {
        return new Response('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Delete operation.
     *
     * @param Request $request
     * @param string  $endpoint
     *
     * @return Response
     */
    public function deleteAction(Request $request, $endpoint = null)
    {
        return new Response('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }
}
