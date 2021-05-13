<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Opdrachten

Deze repository is voor studenten die aan de slag willen met het leren van Laravel8. De opdrachten zijn gekoppeld aan de lessenserie die
geschreven is om stap voor stap het framework te leren. De eisen van de opdrachten staan dan ook in het document beschreven, met daarbij
het commando wat je kan uitvoeren als controle.

## De opdracht

Voor de opdracht zal je aan de slag gaan met een project tool. Dit is om bij te houden hoever een project staat, welke taken er zijn en 
wie de taken moeten uitvoeren. De functionaliteit bestaat uit het volgende:

<ul>
<li>Studenten kunnen een project aanmaken</li>
<li>Bij een project kunnen allerlei taken horen</li>
<li>Een taak heeft een activity status, bijvoorbeeld: Todo, Doing, Testing, Verify, Done</li>
<li>Een taak kan verschillende labels hebben, zoals: front-end, backend, documentation, bug, feature</li>
</ul>

En ja, het ziet er misschien lastig uit, maar de opdrachten zullen steeds een klein stapje zijn. De opdrachten zullen ook heel precies zijn, 
er zijn namelijk automatische testen beschikbaar waar op alle details wordt gelet.

## De installatie (bijv wamp.net server)
Voer de volgende stappen uit om met deze opdrachten aan de slag te gaan.
<ul>
    <li>Clone het project in een directory</li>
    <li>Maak in wamp.net een project aan en zet de document root op de public map. Gebruik minimaal php versie 8</li>
    <li>Zorg dat je bij de phpMyAdmin kan komen</li>
    <li>Maak 2 databases aan, 1 voor de website en 1 voor testen
        <ul>
            <li>Database 1: opdrachten</li>
            <li>Database 2: opdrachtentest (Let op, gebruik je een andere naam, wijzig dit in phpunit.xml</li>
        </ul>
    </li>
    <li>Maak een .env file aan, en kopier de .env.example daar naartoe</li>
    <li>In de .env file, check de database naam (opdrachten) en de username (root)</li>
    <li>Ga naar je root directory van je project in de terminal, en voer daar uit: composer install</li>
    <li>Voer dan in de terminal uit: php artisan key:generate</li>
</ul>

Gebruik je een andere omgeving, dan zal je soortgelijke stappen moeten nemen om de opdrachten klaar te zetten.

## Contact
Wil je ook aan de slag met deze opdrachten en heb je hiervoor de lessenserie met opdracht beschrijvingen nodig. Neem dan contact op met mij via m.koningstein@tcrmbo.nl 
