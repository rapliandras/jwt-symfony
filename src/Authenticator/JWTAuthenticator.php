<?php


namespace App\Authenticator;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class JWTAuthenticator implements AuthenticatorInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    private function isUsernameAndPasswordProvided(Request $request)
    {
        return $request->get('password') !== null && $request->get('username') !== null;
    }

    /**
     * Authenticator is called if the Authorization HTTP header is set.
     *
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization') || $this->isUsernameAndPasswordProvided($request);
    }

    public function authenticate(Request $request): PassportInterface
    {
        $user = new \App\Entity\User();
        return new Passport($user, new PasswordCredentials($request->get('password')), [
        ]);
    }


    /**
     * Let the request pass through, nothing special.
     *
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {

        $this->logger->error("Authentication failed. ".$exception->getMessage());
        return null;
//        return new JsonResponse(["status" => "auth_failed"], Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {

    }

    /**
     * The returned values get pasesd to getUser() and checkCredentials()
     * I'm free to choose the format
     *
     * @param Request $request
     * @return array|mixed
     */
    public function getCredentials(Request $request)
    {
        return [
            "password" => $request->get("password"),
            "username" => $request->get("username")
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // todo find the user by credentials in db
        return new User();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        //todo check user credentials
        return true;
    }

    public function supportsRememberMe()
    {
        // TODO: Implement supportsRememberMe() method.
    }

    public function createAuthenticatedToken(UserInterface $user, string $providerKey)
    {
        // TODO: Implement createAuthenticatedToken() method.
        return new PostAuthenticationGuardToken($user, $providerKey, ['ROLE_USER']);
    }
}