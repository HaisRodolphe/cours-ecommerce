<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class LoginFormAuthenticator extends AbstractGuardAuthenticator
{
    protected $encoder;
    // on se fait livré le service encoder pour pouvoir decodé le mot de passe
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'security_login'
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        return $request->request->get('login'); // array avec 3 infos
        // On vas faire ressortir les 3 info dans un tableau, pour les présenter à la function
        //suivante.
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //Si tout se passe bien j'aimerai retournet return $userProvider->loadUserByUsername($credentials['email'])
        //Mais si il lance une execption alors moi je veus lancer une nouvelle AuthenticationException 
        //avec comme message "Cette adress email n'est pas connue".
        try {
            return $userProvider->loadUserByUsername($credentials['email']);
        } catch (UsernameNotFoundException $e) {
            throw new AuthenticationException("Cette adress email n'est pas connue");
        }

        //Je veux retourné le resultat $userProvider qui a une méthode loadUserByUsername qui à comme email par $credentials['email']
        //grace au info qui ont etait retourné dans l'utilisateur de login.
        //On passe par UserProviderInterface qui se trouve dans le sécurity.yaml ou tout les infos.
        //Sont deja paramétrer app_user_provider: entity: class: App\Entity\User property: email
        //Une fois vérifier ont vas retourné à la méthode checkCredentials.
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // Vérifier que le mot de passe fourni, correspond bien au mot de passe de la base de données.
        //Je veux vérifier que $credentials['passeword'] => $user->getPassword() que sa match bien.
        //Doit retourné vrais ou faux si les valeurs sont valides
        $isValid = $this->encoder->isPasswordValid($user, $credentials['password']);
        //Si elle n'ait pas valide alors elle retourne le message "Les informations de connexion ne correspondent pas".
        if (!$isValid) {
            throw new AuthenticationException("Les informations de connexion ne correspondent pas");
        }
        // Sinon Ok
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // On appel la constante de l'erreur dans Security::AUTHENTICATION_ERROR et on stock l'erreur dans $exception.
        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return new RedirectResponse('/');
        //Si l'authentification a reussit il retourne directement sur home page.
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
