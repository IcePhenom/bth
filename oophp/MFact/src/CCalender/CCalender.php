<?php
/**
 * A CCalender class.
 */
class CCalender {
    /**
     * Properties.
     */
    private $mon = array("","Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December");
    private $name = array(
            '1'=>array(1=>'(Nyårsdagen)',2=>'Svea',3=>'Alfred, Alfrida',4=>'Rut',5=>'Hanna, Hannele, (Trettondagsafton)',6=>'Kasper, Melker, Baltsar, (Trettondedag jul)',7=>'August, Augusta',8=>'Erland',9=>'Gunnar, Gunder',10=>'Sigurd, Sigbritt',11=>'Jan, Jannike',12=>'Frideborg, Fridolf',13=>'Knut',14=>'Felix, Felicia',15=>'Laura, Lorentz',16=>'Hjalmar, Helmer',17=>'Anton, Tony',18=>'Hilda, Hildur',19=>'Henrik',20=>'Fabian, Sebastian',21=>'Agnes, Agneta',22=>'Vincent, Viktor',23=>'Frej, Freja',24=>'Erika',25=>'Paul, Pål',26=>'Bodil, Boel',27=>'Göte, Göta',28=>'Karl, Karla',29=>'Diana',30=>'Gunilla, Gunhild',31=>'Ivar, Joar'),
            '2'=>array(1=>'Max, Maximilian',2=>'(Kyndelsmässodagen)',3=>'Disa, Hjördis',4=>'Ansgar, Anselm',5=>'Agata, Agda',6=>'Dorotea, Doris',7=>'Rikard, Dick',8=>'Berta, Bert',9=>'Fanny, Franciska',10=>'Iris',11=>'Yngve, Inge',12=>'Evelina, Evy',13=>'Agne, Ove',14=>'Valentin',15=>'Sigfrid',16=>'Julia, Julius',17=>'Alexandra, Sandra',18=>'Frida, Fritiof',19=>'Gabriella, Ella',20=>'Vivianne',21=>'Hilding',22=>'Pia',23=>'Torsten, Torun',24=>'Mattias, Mats',25=>'Sigvard, Sivert',26=>'Torgny, Torkel',27=>'Lage',28=>'Maria',29=>'(Skottdagen)',30=>'',31=>''),
            '3'=>array(1=>'Albin, Elvira',2=>'Ernst, Erna',3=>'Gunborg, Gunvor',4=>'Adrian, Adriana',5=>'Tora, Tove',6=>'Ebba, Ebbe',7=>'Camilla',8=>'Siv',9=>'Torbjörn, Torleif',10=>'Edla, Ada',11=>'Edvin, Egon',12=>'Viktoria',13=>'Greger',14=>'Matilda, Maud',15=>'Kristoffer, Christel',16=>'Herbert, Gilbert',17=>'Gertrud',18=>'Edvard, Edmund',19=>'Josef, Josefina',20=>'Joakim, Kim',21=>'Bengt',22=>'Kennet, Kent',23=>'Gerda, Gerd',24=>'Gabriel, Rafael',25=>'(Marie bebådelsedag)',26=>'Emanuel',27=>'Rudolf, Ralf',28=>'Malkolm, Morgan',29=>'Jonas, Jens',30=>'Holger, Holmfrid',31=>'Ester'),
            '4'=>array(1=>'Harald, Hervor',2=>'Gudmund, Ingemund',3=>'Ferdinand, Nanna',4=>'Marianne, Marlene',5=>'Irene, Irja',6=>'Vilhelm, William',7=>'Irma, Irmelin',8=>'Nadja, Tanja',9=>'Otto, Ottilia',10=>'Ingvar, Ingvor',11=>'Ulf, Ylva',12=>'Liv',13=>'Artur, Douglas',14=>'Tiburtius',15=>'Olivia, Oliver',16=>'Patrik, Patricia',17=>'Elias, Elis',18=>'Valdemar, Volmar',19=>'Olaus, Ola',20=>'Amalia, Amelie, Emelie',21=>'Anneli, Annika',22=>'Allan, Glenn',23=>'Georg, Göran',24=>'Vega',25=>'Markus',26=>'Teresia, Terese',27=>'Engelbrekt',28=>'Ture, Tyra',29=>'Tyko',30=>'Mariana, (Valborgsmässoafton)',31=>''),
            '5'=>array(1=>'Valborg, (Första maj)',2=>'Filip, Filippa',3=>'John, Jane',4=>'Monika, Mona',5=>'Gotthard, Erhard',6=>'Marit, Rita',7=>'Carina, Carita',8=>'Åke',9=>'Reidar, Reidun',10=>'Esbjörn, Styrbjörn',11=>'Märta, Märit',12=>'Charlotta, Lotta',13=>'Linnea, Linn',14=>'Halvard, Halvar',15=>'Sofia, Sonja',16=>'Ronald, Ronny',17=>'Rebecka, Ruben',18=>'Erik',19=>'Maj, Majken',20=>'Karolina, Carola',21=>'Konstantin, Conny',22=>'Hemming, Henning',23=>'Desideria, Desirée',24=>'Ivan, Vanja',25=>'Urban',26=>'Vilhelmina, Vilma',27=>'Beda, Blenda',28=>'Ingeborg, Borghild',29=>'Yvonne, Jeanette',30=>'Vera, Veronika',31=>'Petronella, Pernilla'),
            '6'=>array(1=>'Gun, Gunnel',2=>'Rutger, Roger',3=>'Ingemar, Gudmar',4=>'Solbritt, Solveig',5=>'Bo',6=>'Gustav, Gösta',7=>'Robert, Robin',8=>'Eivor, Majvor',9=>'Börje, Birger',10=>'Svante, Boris',11=>'Bertil, Berthold',12=>'Eskil',13=>'Aina, Aino',14=>'Håkan, Hakon',15=>'Margit, Margot',16=>'Axel, Axelina',17=>'Torborg, Torvald',18=>'Björn, Bjarne',19=>'Germund, Görel',20=>'Linda',21=>'Alf, Alvar',22=>'Paulina, Paula',23=>'Adolf, Alice',24=>'',25=>'David, Salomon',26=>'Rakel, Lea',27=>'Selma, Fingal',28=>'Leo',29=>'Peter, Petra',30=>'Elof, Leif',31=>''),
            '7'=>array(1=>'Aron, Mirjam',2=>'Rosa, Rosita',3=>'Aurora',4=>'Ulrika, Ulla',5=>'Laila, Ritva',6=>'Esaias, Jessika',7=>'Klas',8=>'Kjell',9=>'Jörgen, Örjan',10=>'André, Andrea',11=>'Eleonora, Ellinor',12=>'Herman, Hermine',13=>'Joel, Judit',14=>'Folke',15=>'Ragnhild, Ragnvald',16=>'Reinhold, Reine',17=>'Bruno',18=>'Fredrik, Fritz',19=>'Sara',20=>'Margareta, Greta',21=>'Johanna',22=>'Magdalena, Madeleine',23=>'Emma',24=>'Kristina, Kerstin',25=>'Jakob',26=>'Jesper',27=>'Marta',28=>'Botvid, Seved',29=>'Olof',30=>'Algot',31=>'Helena, Elin'),
            '8'=>array(1=>'Per',2=>'Karin, Kajsa',3=>'Tage',4=>'Arne, Arnold',5=>'Ulrik, Alrik',6=>'Alfons, Inez',7=>'Dennis, Denise',8=>'Silvia, Sylvia',9=>'Roland',10=>'Lars',11=>'Susanna',12=>'Klara',13=>'Kaj',14=>'Uno',15=>'Stella, Estelle',16=>'Brynolf',17=>'Verner, Valter',18=>'Ellen, Lena',19=>'Magnus, Måns',20=>'Bernhard, Bernt',21=>'Jon, Jonna',22=>'Henrietta, Henrika',23=>'Signe, Signhild',24=>'Bartolomeus',25=>'Lovisa, Louise',26=>'Östen',27=>'Rolf, Raoul',28=>'Fatima, Leila',29=>'Hans, Hampus',30=>'Albert, Albertina',31=>'Arvid, Vidar'),
            '9'=>array(1=>'Sam, Samuel',2=>'Justus, Justina',3=>'Alfhild, Alva',4=>'Gisela',5=>'Adela, Heidi',6=>'Lilian, Lilly',7=>'Kevin, Roy',8=>'Alma, Hulda',9=>'Anita, Annette',10=>'Tord, Turid',11=>'Dagny, Helny',12=>'Åsa, Åslög',13=>'Sture',14=>'Ida',15=>'Sigrid, Siri',16=>'Dag, Daga',17=>'Hildegard, Magnhild',18=>'Orvar',19=>'Fredrika',20=>'Elise, Lisa',21=>'Matteus',22=>'Maurits, Moritz',23=>'Tekla, Tea',24=>'Gerhard, Gert',25=>'Tryggve',26=>'Enar, Einar',27=>'Dagmar, Rigmor',28=>'Lennart, Leonard',29=>'Mikael, Mikaela',30=>'Helge',31=>''),
            '10'=>array(1=>'Ragnar, Ragna',2=>'Ludvig, Love',3=>'Evald, Osvald',4=>'Frans, Frank',5=>'Bror',6=>'Jenny, Jennifer',7=>'Birgitta, Britta',8=>'Nils',9=>'Ingrid, Inger',10=>'Harry, Harriet',11=>'Erling, Jarl',12=>'Valfrid, Manfred',13=>'Berit, Birgit',14=>'Stellan',15=>'Hedvig, Hillevi',16=>'Finn',17=>'Antonia, Toini',18=>'Lukas',19=>'Tore, Tor',20=>'Sibylla',21=>'Ursula, Yrsa',22=>'Marika, Marita',23=>'Severin, Sören',24=>'Evert, Eilert',25=>'Inga, Ingalill',26=>'Amanda, Rasmus',27=>'Sabina',28=>'Simon, Simone',29=>'Viola',30=>'Elsa, Isabella',31=>'Edit, Edgar'),
            '11'=>array(1=>'',2=>'Tobias',3=>'Hubert, Hugo',4=>'Sverker',5=>'Eugen, Eugenia',6=>'Gustav Adolf',7=>'Ingegerd, Ingela',8=>'Vendela',9=>'Teodor, Teodora',10=>'Martin, Martina',11=>'Mårten',12=>'Konrad, Kurt',13=>'Kristian, Krister',14=>'Emil, Emilia',15=>'Leopold',16=>'Vibeke, Viveka',17=>'Naemi, Naima',18=>'Lillemor, Moa',19=>'Elisabet, Lisbet',20=>'Pontus, Marina',21=>'Helga, Olga',22=>'Cecilia, Sissela',23=>'Klemens',24=>'Gudrun, Rune',25=>'Katarina, Katja',26=>'Linus',27=>'Astrid, Asta',28=>'Malte',29=>'Sune',30=>'Andreas, Anders',31=>''),
            '12'=>array(1=>'Oskar, Ossian',2=>'Beata, Beatrice',3=>'Lydia',4=>'Barbara, Barbro',5=>'Sven',6=>'Nikolaus, Niklas',7=>'Angela, Angelika',8=>'Virginia',9=>'Anna',10=>'Malin, Malena',11=>'Daniel, Daniela',12=>'Alexander, Alexis',13=>'Lucia',14=>'Sten, Sixten',15=>'Gottfrid',16=>'Assar',17=>'Stig',18=>'Abraham',19=>'Isak',20=>'Israel, Moses',21=>'Tomas',22=>'Natanael, Jonatan',23=>'Adam',24=>'Eva, (Julafton)',25=>'(Juldagen)',26=>'Stefan, Staffan, (Annandag jul)',27=>'Johannes, Johan',28=>'Benjamin, (Värnlösa barns dag)',29=>'Natalia, Natalie',30=>'Abel, Set',31=>'Sylvester, (Nyårsafton)')
            );
    private $flag = array(
            '1'=>array(1, 28),
            '2'=>array(),
            '3'=>array(12),
            '4'=>array(30),
            '5'=>array(1),
            '6'=>array(6),
            '7'=>array(14),
            '8'=>array(8),
            '9'=>array(),
            '10'=>array(24),
            '11'=>array(6),
            '12'=>array(10, 23, 25)
            );
    private $red = array(
            '1'=>array(1, 6),
            '2'=>array(),
            '3'=>array(),
            '4'=>array(),
            '5'=>array(1),
            '6'=>array(6),
            '7'=>array(),
            '8'=>array(),
            '9'=>array(),
            '10'=>array(),
            '11'=>array(),
            '12'=>array(25, 26)
            );

    /**
     * Constructor.
     */
    public function __construct() {
        self::initnon();
    }

    private function initnon(){
        self::init(date('Y'));
    }

    private function init($year){
        //midsommardagen
        self::midsummer($year);

        //påsk
        self::easter(easter_days($year));

        //kristi himmel
        self::krist(easter_days($year));

        //pingst
        self::pingst(easter_days($year));

        //Alla helgons dag
        self::halloween($year);
    }

    private function halloween($year){
        if(date('w', mktime(0, 0, 0, 10, 31, $year)) == 6){
            self::addToDay(30, 10, ", (Allhelgona afton)", false, false);
            self::addToDay(31, 10, "(Alla helgons dag)", false, true);
        }
        elseif(date('w', mktime(0, 0, 0, 11, 1, $year)) == 6){
            self::addToDay(31, 10, ", (Allhelgona afton)", false, false);
            self::addToDay(1, 11, "(Alla helgons dag)", false, true);
        }
        else{
            for ($i=2; $i < 7; $i++)
                if(date('w', mktime(0, 0, 0, 11, $i, $year)) == 6){
                    self::addToDay($i-1, 11, ", (Allhelgona afton)", false, false);
                    self::addToDay($i, 11, "(Alla helgons dag)", false, true);
                    break;
                }
        }
    }

    private function midsummer($year){
        for ($i=20; $i < 27; $i++)
            if(date('w', mktime(0, 0, 0, 6, $i, $year)) == 6){
                self::addToDay($i-1, 6, ", (Midsommar afton)", false, false);
                self::addToDay($i, 6, ", (Midsommar dagen)", true, true);
                break;
            }
    }

    private function pingst($days){
        $x = $days + 9;
        (($x > 31)? self::addToDay($x - 31, 6, ", (Pingstdagen)", true, false) : self::addToDay($x, 5, ", (Pingstdagen)", true, false));
    }

    private function krist($days){
        $x = $days - 1;

        if($x < 0)
            self::addToDay(30, 4, ", (Kristi himmelsfärd)", false, true);
        elseif($x > 31)
            self::addToDay($x -31, 6, ", (Kristi himmelsfärd)", false, true);
        else
            self::addToDay($x, 5, ", (Kristi himmelsfärd)", false, true);
    }

    private function easter($days){
        $easter = ($days+21)%31;

        self::addToDay($easter -3, ($easter - 3 < 0? 3: 4), ", (Skärtorsdag)", false, false);
        self::addToDay($easter -2, ($easter - 2 < 0? 3: 4),", (Långfredag)", false, true);
        self::addToDay($easter -1, ($easter - 1 < 0? 3: 4),", (Påskafton)", false, false);
        self::addToDay($easter, ($easter < 0? 3: 4),", (Påskdagen)", true, false);
        self::addToDay($easter +1, ($easter + 1 < 0? 3: 4),", (Annandag påsk)", false, true);
    }

    private function addToDay($day, $month, $text, $flag, $red){
        $this->name[$month][$day] .= $text;
        if($flag)
            array_push($this->flag[$month], $day);
        if($red)
            array_push($this->red[$month], $day);
    }

    private function flagDay($day, $month, $mini){
        if(in_array($day, $this->flag[$month]))
            return ($mini? "<img src='img/swe_small.gif' alt='flag'>" : "<img src='img/swe.gif' alt='flag'>");
    }

    private function nameDay($day, $month){
        return (array_key_exists($day, $this->name[$month])? $this->name[$month][$day] : "");
    }

    private function redDay($day, $month, $theday){
        return ($theday == 6 || in_array($day, $this->red[$month])? "redText": "");
    }

    private function today($month, $day, $year){
        $tm = date("U", mktime(0, 0, 0, $month, $day, $year)) - 86400;
        $tn = date("U", mktime(0, 0, 0, $month, $day, $year));
        $tp = date("U", mktime(0, 0, 0, $month, $day, $year)) + 86400;

        return ($tn > $tm && $tn < $tp && date('j') == $day && date('m') == $month && date('Y') == $year)? "todayBack" : "";
    }

    private function preMonth($theday, $month, $year){
        $daysinmonthprev = date("t", mktime(0, 0, 0, $month-1, 1, $year)) - $theday;
        $ret = "";
        for ($i = 0; $i < $theday; $i++)
            $ret .= "<td class='round notMonth'>".++$daysinmonthprev."</td>";
        return $ret;
    }

    private function postMonth($theday){
        $ret = "";
        for ($i = $theday, $day = 1; $i < 7; $i++, $day++)
            $ret .= "<td class='round notMonth'>".$day."</td>";
        return $ret;
    }

    private function getMonthName($month){
        return $this->mon[$month];
    }

    private function weekRow($mini){
        return ($mini? "<td class='week'>V.</td><td class='calendarSmalltd'>Mån</td><td class='calendarSmalltd'>Tis</td><td class='calendarSmalltd'>Ons</td><td class='calendarSmalltd'>Tor</td><td class='calendarSmalltd'>Fre</td><td class='calendarSmalltd'>Lör</td><td class='calendarSmalltd redText'>Sön</td>"
            : "<td>V.</td><td class='calendarBigtd'>Mån</td><td class='calendarBigtd'>Tis</td><td class='calendarBigtd'>Ons</td><td class='calendarBigtd'>Tor</td><td class='calendarBigtd'>Fre</td><td class='calendarBigtd'>Lör</td><td class='calendarBigtd redText'>Sön</td>");
    }

    private function calendarHead($mini, $month, $year){
        $prevmonth = ($month == '1'? '12' : $month - 1);
        $prevyear  = ($month == '1'? $year - 1 : $year);
        $nextmonth = ($month == '12'? '1': $month +1);
        $nextyear  = ($month == '12'? $year + 1: $year);

        $ret = ($mini? "<div class='calendar calendarSmall'>" : "<div class='calendar calendarBig'><img class='topImg' alt='image' src='img/cal/".$month.".jpg'>");
        $ret .= "<div class='center'><a href='?month=".$prevmonth."&amp;year=".$prevyear."'>&laquo; </a>".self::getMonthName($month)." - ".$year."<a href='?month=".$nextmonth."&amp;year=".$nextyear."'> &raquo;</a></div><table><tr>";
        $ret .= self::weekRow($mini)."</tr>";
        return $ret;
    }

    public function show($mini=false){
        //Recalc red days on new year.
        if(!empty($_GET['year']))
            if(date('Y') != $_GET['year'])
                self::init($_GET['year']);

        $month     = (empty($_GET['month'])? date('n') : $_GET['month']);
        $year      = (empty($_GET['year'])? date('Y') : $_GET['year']);

        $theday    = date('w', mktime(0, 0, 0, $month, 0, $year));
        $daysmonth = date("t", mktime(0, 0, 0, $month, 1, $year));
        $week      = date('W', mktime(0, 0, 0, $month, 1, $year));

        $html = self::calendarHead($mini, $month, $year);
        $html .="<tr><td class='week'>".$week++."</td>";
        $html .= self::preMonth($theday, $month, $year);

        for ($list_day = 1; $list_day <= $daysmonth; $list_day++, $theday++) {
            $html .= "<td class='round month ".self::today($month, $list_day, $year)." ".self::redDay($list_day, $month, $theday)."'>".$list_day.self::flagDay($list_day, $month, $mini);
            $html .= ($mini? "": "<br>".self::nameDay($list_day, $month))."</td>";

            if ($theday == 6) {
                $html .= "</tr><tr><td class='week'>".$week++."</td>";
                $theday = -1;
            }
        }

        $html .= self::postMonth(date('w', mktime(0, 0, 0, $month, $daysmonth, $year)));
        $html .= "</tr></table></div>";

        return $html;
    }
}
