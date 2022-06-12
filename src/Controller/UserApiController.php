<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserApiController extends AbstractController
{
    /**
     * @Route("/user/signup", name="user_signup")
     */
    public function signupAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $username = $request->query->get("username");
        $email = $request->query->get("email");
        $firstName = $request->query->get("firstname");
        $lastName = $request->query->get("lastname");


        $password = $request->query->get("password");


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new Response("email invalid");
        }
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setFirstName($firstName);

        $user->setLastName($lastName);
        $user->setPassword($passwordEncoder->encodePassword(
            $user,
            $password));


        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse("Account is created", 200);
        } catch (\Exception $ex) {

            return new Response("execption" . $ex->getMessage());
        }


    }

    /**
     * @Route("/user/signin", name="user_signin")
     */
    public function login(Request $request,NormalizerInterface $normalizer,UserPasswordEncoderInterface $passwordEncoder):Response
    {
        $email = $request->get('email');
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByEmail($email);
        $pass = $request->get("password");
        if ($user) {
            if ($passwordEncoder->isPasswordValid($user, $pass)) {
                $json = $normalizer->normalize($user, 'json');
                return new JsonResponse($json);

            }
        }
        $json1 = $normalizer->normalize("null", 'json');
        return new JsonResponse("null");
    }

    /*public function signin(Request $request, UserPasswordEncoderInterface $passwordEncoder )
{
    $email = $request->query->get("email");
    $password = $request->query->get("password");

    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

    if ($user)
    {

        if ($passwordEncoder->isPasswordValid($user , $password)
        {
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($user);
            return new JsonResponse($formatted);
        } else
        {
            return new Response("password not found");
        }}

    else{
            return new Response("user not found");
        }

    }*/
    /**
     * @Route("/user/editUser", name="user_gesttion_profile")
     */
    public function editUser(Request $request , UserPasswordEncoderInterface $passwordEncoder){
        $id = $request-> get("id");
        $username = $request->query->get("username");
        $email = $request->query->get("email");
        $lastName = $request->query->get("lastName");
        $firstName = $request->query->get("firstName");

        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository(User::class)->find($id);


        $user->setUsername($username);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse($user, 200);
        } catch (\Exception $ex) {

            return new Response("failed" . $ex->getMessage());
        }


    }
    /**
     * @Route("/user/give-user",name="give_user")
     */
    public function giveuser(Request $request,NormalizerInterface $normalizer):Response{
        $id = $request->get('id');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if($user){

            $json = $normalizer->normalize($user,'json');
            return new JsonResponse($json);

        }
        $json1 = $normalizer->normalize("null",'json');
        return new JsonResponse("null");

    }

    /**
     * @Route("/user/getusers",name="get_users")
     */
    public function getusers(Request $request,NormalizerInterface $normalizer):Response{
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        if($users){

            $json = $normalizer->normalize($users,'json');
            return new JsonResponse($json);

        }
        $json1 = $normalizer->normalize("null",'json');
        return new JsonResponse("null");

    }



}
