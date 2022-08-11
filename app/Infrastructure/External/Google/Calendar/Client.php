<?php

declare(strict_types=1);

namespace App\Infrastructure\External\Google\Calendar;

use Google\Service\Storage;
use Google_Client;
use Google_Service_Calendar;
use Exception;
use Illuminate\Support\Facades\Storage as FileStorage;

class Client
{
    /**
     * @throws Exception
     */
    public function __construct(private Google_Client $client)
    {
    }

    public function getCalendar(): void
    {
        $service = new Google_Service_Calendar($this->client);
        $calendarId = 'primary';
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        if (empty($events)) {
            print "No upcoming events found.\n";
        } else {
            print "Upcoming events:\n";
            foreach ($events as $event) {
                $start = $event->start->dateTime;
                if (empty($start)) {
                    $start = $event->start->date;
                }
                printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
    }

    /**
     * @throws Exception
     */
    private function getClient(Google_Client $client): void
    {
        $this->client = $client;
        $this->client->setApplicationName('Google Calendar API PHP Quickstart');
        $this->client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
        $this->client
            ->setAuthConfig("/app/app/Calendar/Services/credentials.json");
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $this->client->setRedirectUri(
            'https://' .
            $_SERVER['HTTP_HOST'] .
            '/oauth2callback.php'
        );

        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(
                file_get_contents($tokenPath),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            $this->client->setAccessToken($accessToken);
        }

        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken(
                    $this->client->getRefreshToken()
                );
            } else {
                $authUrl = $this->client->createAuthUrl();
                printf(
                    "Open the following link in your browser:\n%s\n",
                    $authUrl
                );

                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                $accessToken = $this->client
                    ->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                if (array_key_exists('error', $accessToken)) {
                    throw new Exception($accessToken);
                }
            }

            if (
                !file_exists(dirname($tokenPath)) &&
                !mkdir(
                    $concurrentDirectory = dirname($tokenPath),
                    0700,
                    true
                ) &&
                !is_dir($concurrentDirectory)
            ) {
                throw new \RuntimeException(sprintf(
                    'Directory "%s" was not created',
                    $concurrentDirectory
                ));
            }
            file_put_contents(
                $tokenPath,
                json_encode(
                    $this->client->getAccessToken(),
                    JSON_THROW_ON_ERROR
                )
            );
        }
    }
}
