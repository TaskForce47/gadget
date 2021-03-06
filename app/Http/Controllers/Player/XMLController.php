<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Http\Models\Team;
use Illuminate\View\View;

class XMLController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generate()
    {
        chdir('squad');
        $teams = Team::all();
        foreach ($teams as $team)
        {
            if(!file_exists($team->directory))
            {
                mkdir($team->directory);
            }
            chdir($team->directory);

            $countries = ['de', 'at', 'ch'];

            foreach ($countries as $country) {
                if(file_exists('squad_'.$country.'.xml')) {
                    unlink('squad_'.$country.'.xml');
                }
                $this->generateXML($country, $team);
            }

            chdir('..');
        }

        $html = view("xml.index", ['teams' => Team::all()])->render();
        file_put_contents("index.html", $html);

        return redirect('squad');
    }

    /**
     * @param $country
     * @param $team
     * @return \XMLWriter
     */
    public function generateXML($country, $team)
    {
        $xml = new \XMLWriter();
        $xml->openURI('squad_' . $country . '.xml');
        $xml->startDocument();
        $xml->writeDTD('squad', NULL, '../style/tf47_squad.dtd');
        $xml->writePI('xml-stylesheet', 'href="../style/tf47_squad.xsl" type="text/xsl"');
        $xml->setIndent(4);
        $xml->startElement('squad');
        $xml->writeAttribute('nick', $team->title);

        $xml->writeElement('name', $team->name);
        $xml->writeElement('email', $team->email);
        $xml->writeElement('web', $team->web);
        $xml->writeElement('picture', $team->directory . '_' . $country . '.paa');
        $xml->writeElement('title', $team->tag);

        foreach ($team->players as $player) {
            $xml->startElement('member');
            $xml->writeAttribute('id', $player->player_id);
            $xml->writeAttribute('nick', $player->name);
            $xml->writeElement('name', $player->name);
            $xml->writeElement('email', $player->email);
            $xml->writeElement('icq',
                'ICQ: ' . ($player->icq == '' ? 'N/A' : $player->icq) . ' ' .
                'Steam: ' . ($player->steam == '' ? 'N/A' : $player->steam) . ' ' .
                'Sykpe: ' . ($player->skype == '' ? 'N/A' : $player->skype));
            $xml->writeElement('remark', $player->remark);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();
        $xml->flush();
    }
}
