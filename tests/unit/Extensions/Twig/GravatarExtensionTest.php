<?php

use PodcastSite\Extensions\Twig\GravatarExtension;

/**
 * Class EpisodeTest
 *
 * @coversDefaultClass \PodcastSite\Extensions\Twig\GravatarExtension
 */
class GravatarExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
    }

    /**
     * @covers ::renderGuestGravatar
     */
    public function testCanGenerateCorrectGravatarUrlFromEmailAddress()
    {
        $email = 'matthew@matthewsetter.com';
        $extension = new GravatarExtension();

        $this->assertEquals(
            $extension->renderGuestGravatar($email),
            "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))),
            "Gravatar generated does not match expected value"
        );
    }

    /**
     * @covers ::renderGuestGravatar
     */
    public function testReturnsFalseWhenNoEmailAddressAvailable()
    {
        $extension = new GravatarExtension();
        $this->assertFalse($extension->renderGuestGravatar(''), 'Missing email should return false');
    }
}
