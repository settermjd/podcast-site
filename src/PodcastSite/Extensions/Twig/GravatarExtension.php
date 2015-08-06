<?php

namespace PodcastSite\Extensions\Twig;

class GravatarExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('guestGravatar', array($this, 'renderGuestGravatar')),
        );
    }

    /**
     * Render a Gravatar URL if the email address is not empty
     *
     * @param $email
     * @return string
     */
    public function renderGuestGravatar($email)
    {
        if (!empty($email)) {
            return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));
        }
        return false;
    }

    public function getName()
    {
        return 'podcastsite_guestgravatar';
    }
}