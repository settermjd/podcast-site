<?php

namespace PodcastSite\Extensions\Twig;

/**
 * Class GravatarExtension.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class GravatarExtension extends \Twig_Extension
{
    /**
     * Return the list of filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('guestGravatar', [$this, 'renderGuestGravatar']),
        ];
    }

    /**
     * Render a Gravatar URL if the email address is not empty.
     *
     * @param $email
     *
     * @return string
     */
    public function renderGuestGravatar($email)
    {
        if (!empty($email)) {
            return 'http://www.gravatar.com/avatar/'.md5(strtolower(trim($email)));
        }

        return false;
    }

    /**
     * Get the name of the extension.
     *
     * @return string
     */
    public function getName()
    {
        return 'podcastsite_guestgravatar';
    }
}
