<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_korisnici();
seed_table_kvizovi();
seed_table_tipovi();
seed_table_pitanja();
seed_table_odgovori();

exit( 0 );

// ------------------------------------------
function seed_table_korisnici()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_korisnici(is_admin, username, password_hash, email, registration_sequence, has_registered) VALUES (:is_admin, :username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'is_admin' => 1, 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'is_admin' => 0, 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'is_admin' => 0, 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'is_admin' => 0, 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'is_admin' => 0, 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert kviz_korisnici]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu kviz_korisnici.<br />";
}


// ------------------------------------------
function seed_table_kvizovi()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_kvizovi(name, is_type1, is_type2, is_type3) VALUES (:name, :is_type1, :is_type2, :is_type3)' );

		$st->execute( array('name' => 'STEM', 'is_type1' => 1, 'is_type2' => 1, 'is_type3' => 1 ) );
        $st->execute( array('name' => 'SPORT', 'is_type1' => 1, 'is_type2' => 1, 'is_type3' => 1 ) );
        $st->execute( array('name' => 'GLAZBA', 'is_type1' => 1, 'is_type2' => 1, 'is_type3' => 1 ) );
        $st->execute( array('name' => 'FILM', 'is_type1' => 0, 'is_type2' => 1, 'is_type3' => 1 ) );

	}
	catch( PDOException $e ) { exit( "PDO error [kviz_kvizovi]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu kviz_kvizovi.<br />";
}

// ------------------------------------------
function seed_table_tipovi()
{
    $db = DB::getConnection();

    // Ubaci neke proizvode unutra (ovo nije bas pametno ovako raditi, preko hardcodiranih id-eva usera)
    try
    {
        $st = $db->prepare( 'INSERT INTO kviz_tipovi(name) VALUES (:name)' );

        $st->execute( array('name' => 'točno/netočno') );
        $st->execute( array('name' => 'odaberi') );
        $st->execute( array('name' => 'popuni') );
    }
    catch( PDOException $e ) { exit( "PDO error [kviz_tipovi]: " . $e->getMessage() ); }

    echo "Ubacio u tablicu kviz_tipovi.<br />";
}

// ------------------------------------------
function seed_table_pitanja()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO kviz_pitanja(id_quiz, id_type, question) VALUES (:id_quiz, :id_type, :question)' );

        //stem
		$st->execute( array( 'id_quiz' => 1, 'id_type' => 1, 'question' => 'Baza piramide može imati najmanje 3 brida.' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Kako se zove neutralni element zbrajanja koji pripada skupu cijelih brojeva Z?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 3, 'question' => 'Koja tipka se nalazi u donjem lijevom kutu standardne Windows tipkovnice? (skraćenica)' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 3, 'question' => 'Za koju računsku operaciju su nam potrebni baza i eksponent?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Kako se naziva paralelogram koji ima sve stranice jednake, ali nema pravi kut između njih? ' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 1, 'question' => 'Konkluzija je drugi naziv za zaključak koji je izveden iz datih premisa. ' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Kako se zove tip USB konektora, trenutni standard za punjenje mobitela, koji je prvi koji ima simetrične pinove, što znači da se može, napokon, uštekati u utor neovisno kako je okrenut?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Proširenjem skupa cijelih brojeva nastao je skup kakvih brojeva koji nose oznaku Q?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 3, 'question' => 'Koji test će umjetna inteligencija zadovoljiti, ako ljudski promatrač ne može razaznati radi li se o čovjeku ili umjetnoj inteligenciji?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 3, 'question' => 'Kako se naziva broj koji odgovara broju 1 sa 100 nula, odnosno 10 na 100tu? Jedna popularna i poznata tvrtka se htjela nazvati po tom broju, ali su malko zeznuli slova pa se ne zovu identično.' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 1, 'question' => 'Brojevi 6, 28, 496 itd pripadaju skupini savršenih brojeva zato što su jednaki zbroju svojih djeljitelja osim samog sebe ( 6= 1+2+3, 28=1+2+4+7+14). ' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Koliko iznosi najveći polumjer kugle koju možemo staviti unutar kocke brida duljine 2cm?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 3, 'question' => 'Čiji trokut se koristi kako bi se determinirali binomni koeficijenti?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 2, 'question' => 'Prema prezimenu engleskog logičara koji ih je prvi opisao, kako se zovu ovi dijagrami, specijalni slučaj Eulerovih dijagrama, a najčešće ih koristimo za prikaz unija, presjeka i razlika dvaju ili više skupova?' ) );
        $st->execute( array( 'id_quiz' => 1, 'id_type' => 1, 'question' => 'U standardnom kartezijevom dvodimenzinalnom koordinatnom sustavu x os se naziva ordinata, a y os apscisa. ' ) );

        //sport
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Mirko Filipović svjetski je poznati borac, no manje je znano da je zaigrao i nogomet u drugoj hrvatskoj ligi. Za koji klub?' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 3, 'question' => 'Na putu prema osvajanju Wimbledona 2001. godine Goranu Ivaniševiću nije sve išlo baš glatko. Tako je u jednom meču koji je dobio sa 3:2 jedan od setova izgubio sa 6:0. Od kojeg tenisača?' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 1, 'question' => 'Netom prije početka zimskih olimpijskih igara 2018. godine, u Sloveniji se naveliko raspravljalo smije li ili ne smije jakov fak nositi zastavu na otvaranju igara, pa je on sam odustao.' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 1, 'question' => 'Nije baš uobičajeno da aerodromi nose imena prema sportašima, pa ipak jedan je značajan aerodrom u Belfastu dobio ime prema poznatom košarkašu.' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Hrvatska rukometna reprezentacija prve uspjehe ostvarila je osvajanjem bronce na Europskom prvenstvu 1994. i srebra na svjetskom prvenstvu godinu dana kasnije. Tko je tada bio izbornik? ' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Međunarodni olimpijski komitet do sada je od prvog Vikelasa do zadnjeg Bacha imao devet predsjednika. Oni su bili iz osam različitih država. Koja je država dala dva predsjednika? ' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 1, 'question' => 'Kolika god zvijezda bio Michael Jordan, on ipak nije bio prvi pick na NBA draftu održanom 1984. godine. Bio je tek treći, drugi je bio Sam Bowie, a prvi Hakeem Olajuwon.' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 3, 'question' => 'Steaua je jedini naslov prvaka Europe u nogometu osvojila protiv Barcelone igrajući finale u Španjolskoj. U kojem se gradu igralo to finale? ' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 3, 'question' => 'Ako su u footbalu Cardinalsi, u baseballu Diamondbacksi, u hokeju Coyotesi, koja franšiza/klub predstavlja taj grad u košarci?' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 1, 'question' => 'Stil u hrvanju kod kojeg je dopušteno hvatanje protivnika isključivo iznad pojasa naziva se slobodni stil.' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Utakmica u američkom NFL-u započinje početnim udarcem koji nogom izvodi igrač postavivši loptu na koliko jardi od svoje end zone?' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Zagrebačka Mladost osvojila je prvih 12 naslova prvaka Hrvatske u odbojci za seniore. Iz kojeg grada je bio klub koji je prekinuo taj niz 2004. godine?' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 3, 'question' => 'Zagrebački Dinamo nikad u europskim kupovima nije propustio prednost od tri ili više golova iz prve utakmice, a jednom je tu prednost i stigao. Protiv kojeg kluba? ' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 2, 'question' => 'Braća Glasnović spadaju u svjetski vrh u trapu. Josip je osvajač zlatne olimpijske medalje u Riju 2016. godine, a kako se zove njegov brat koji je 2018. bio srebrni na Europskom prvenstvu? ' ) );
        $st->execute( array( 'id_quiz' => 2, 'id_type' => 1, 'question' => 'Obično se od domaćina ljetnih olimpijskih igara očekuje da budu uspješni na njima, no Kanada kao država domaćin nije uspjela osvojiti ni jednu zlatnu medalju na ljetnim igrama koje je organizirala.' ) );
        
        //glazba
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Koja ista jedna riječ čini naslov pjesama U2, Metallice i Three Dog Night, a također je i dio naziva grupe čiji je bivši član Zayn Malik?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 1, 'question' => 'Donji Miholjac hrvatski grad koji se nalazi u nazivu pjesme koji je prepjev velikog hita Alicie Keys i Jay Z-a "Empire State of Mind".' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'S cijenom od 7 miliona USD, ovaj spot je po Guinessu najskuplji ikada. Napravljen je 1995., a duet koji ga je otpjevao dijeli isto prezime. Navedite ime pjesme?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 1, 'question' => 'Goran Bare je hrvatski rock glazbenik je snimio osebujni mini album 1991. pod pseudonimom Hali Gali Halid.' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 2, 'question' => 'Koji po redu je prvi album Led Zeppelina koji nije nazvan po imenu banda?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Koja država se spominje u imenu projekta koji čine Sebastian Ingrosso, Axwell i Steve Angello?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Navedite ime najpoznatijeg bara u mjestu Sant Antoni de Portmany, Ibiza, ako znamo da od 1994. svake godine izlazi kompilacija lounge i chillout glazbe pod tim imenom? ' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Navedite ime i prezime kompozitora čije je najpoznatije djelo iskorišteno u povijesnom uspjehu sportskog para Christopher Dean i JayneTorvill 1984.godine?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 1, 'question' => 'Inauguralna Eurovizija 1956.godine ugostila je Belgiju, Francusku, Njemačku, Luksemburg, Nizozemsku, Italiju i Izrael.' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Navedite ime debut albuma grunge grupe iz 1991. koja u imenu sadrži ime prabake pjevača banda, a prije toga su se zvali Mookie Blaylock, po NBA košarkašu?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 2, 'question' => 'Kojim se engleskim nazivom u glazbenom žargonu naziva izvođač koji je postao popularan i zapamćen po samo jednom velikom hitu? ' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Tko je uglazbio pjesmu Antuna Mihanovića "Horvatska domovina"?' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 1, 'question' => 'Dubioza Kolektiv dijeli svoju često viđenu dvobojnu odjevnu kombinaciju s bojom dresova Villa Real.' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 3, 'question' => 'Koji to britanski izvođač/ica gay svjetonazora uz Oscara i nekoliko Grammyja drži i Guinessov rekord za prvu James Bond temu koja je dosegnula broj 1 na UK chartu? ' ) );
        $st->execute( array( 'id_quiz' => 3, 'id_type' => 2, 'question' => 'Za koju podvrstu heavy metala od šest slova kažemo da mu je mjesto nastanka Bay Area scena (San Francisco)?' ) );

        //film
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Ako je vjerovati likovima iz serije Stranger Things, kakvo je disanje odlika glupih ljudi?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Izvan kojeg gradića u Missouriju se nalaze tri plakata koje je majka jedne ubijene djevojke odlučila zakupiti nezadovoljna radom policije?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Kušanje kojeg jela je strogog gastro-kritičara u crtiću Ratatouille u trenutku vratilo u djetinjstvo na francuskom selu? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Na popisu najbolje ocijenjenih filmova o Batmanu prema Tomatometeru stranice Rotten Tomatoes, na drugom mjestu s 90% pozitivnih recenzija nalazi se film koji u naslovu ima naziv koje danske kompanije? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Ulogu naratora i voditelja u dokumentarnom serijalu National Geographic kanala The Story of God dobio je koji glumac, koji je u svojoj dotadašnjoj karijeri već dva puta igrao ulogu boga? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Koji je glumac 1994. nakon uloge u filmu River Wild izjavio da za svakoga u Hollywoodu može reći da je s njim radio ili da je radio s nekim tko je s njim radio? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Koji član nedostaje u superherojskoj družini koju još čine Jack-Jack, Dash, Violet i Elastigirl? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'U koji fikcionalni gradić iz mašte i pera Stephena Kinga je smještena radnja istoimene serije iz 2018., isprepletene likovima i motivima iz cjelokupnog Kingovog opusa? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Cover teme iz koje serije su 2Cellos snimili u Dubrovniku, prigodno odjeveni u pseudo- povijesne kostime (eng. naziv)?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Koliko je, onako okruglo, L.A. udaljen od Barcelone?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'U Shyamalanovom filmu Sixth Sense mali Cole (H.J. Osment) majci dokaže da komunicira s duhovima kad joj kaže bakin odgovor na jedno njeno pitanje. Kako glasi odgovor? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'Koja prirodna nepogoda je katalizator raspada naizgled savršene obitelji u švedskoj drami Turist (Force Majeure) iz 2014.?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Kojim je filmom Paolo Sorrentino 2013. ušao u društvo u kojem su još i Fellini, De Sica, Petri, Tornatore, Salvatores i Benigni? ' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 3, 'question' => 'U koji grad u Pennsylvaniji je smještena radnja američke verzije serije „The Office“?' ) );
        $st->execute( array( 'id_quiz' => 4, 'id_type' => 2, 'question' => 'Kojem je fikcionalnom liku British Medical Journal 2013. dijagnosticirao alkoholizam? ' ) );

		
	}
	catch( PDOException $e ) { exit( "PDO error [kviz_pitanja]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu kviz_pitanja.<br />";
}

                            
// ------------------------------------------
function seed_table_odgovori()
{
    $db = DB::getConnection();

    try
    {
        $st = $db->prepare( 'INSERT INTO kviz_odgovori(id_question, is_true, answer) VALUES (:id_question, :is_true, :answer)' );
        
        $st->execute( array( 'id_question' => 1, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 1, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 2, 'is_true' => 1, 'answer' => 'nula' ) );
        $st->execute( array( 'id_question' => 2, 'is_true' => 0, 'answer' => 'none' ) );
        $st->execute( array( 'id_question' => 2, 'is_true' => 0, 'answer' => 'jedan' ) );
        $st->execute( array( 'id_question' => 2, 'is_true' => 0, 'answer' => 'ništa od navedenog' ) );
        $st->execute( array( 'id_question' => 3, 'is_true' => 1, 'answer' => 'ctrl' ) );
        $st->execute( array( 'id_question' => 4, 'is_true' => 1, 'answer' => 'potenciranje' ) );
        $st->execute( array( 'id_question' => 5, 'is_true' => 0, 'answer' => 'trapez' ) );
        $st->execute( array( 'id_question' => 5, 'is_true' => 0, 'answer' => 'kvadrat' ) );
        $st->execute( array( 'id_question' => 5, 'is_true' => 0, 'answer' => 'trokut' ) );
        $st->execute( array( 'id_question' => 5, 'is_true' => 1, 'answer' => 'romb' ) );
        $st->execute( array( 'id_question' => 6, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 6, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 7, 'is_true' => 0, 'answer' => 'a' ) );
        $st->execute( array( 'id_question' => 7, 'is_true' => 0, 'answer' => 'b' ) );
        $st->execute( array( 'id_question' => 7, 'is_true' => 1, 'answer' => 'c' ) );
        $st->execute( array( 'id_question' => 7, 'is_true' => 0, 'answer' => 'd' ) );
        $st->execute( array( 'id_question' => 8, 'is_true' => 0, 'answer' => 'realni' ) );
        $st->execute( array( 'id_question' => 8, 'is_true' => 1, 'answer' => 'racionalni' ) );
        $st->execute( array( 'id_question' => 8, 'is_true' => 0, 'answer' => 'iracionalni' ) );
        $st->execute( array( 'id_question' => 8, 'is_true' => 0, 'answer' => 'prirodni' ) );
        $st->execute( array( 'id_question' => 9, 'is_true' => 1, 'answer' => 'turingov' ) );
        $st->execute( array( 'id_question' => 10, 'is_true' => 1, 'answer' => 'googol' ) );
        $st->execute( array( 'id_question' => 11, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 11, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 12, 'is_true' => 0, 'answer' => '0.5 cm' ) );
        $st->execute( array( 'id_question' => 12, 'is_true' => 1, 'answer' => '1 cm' ) );
        $st->execute( array( 'id_question' => 12, 'is_true' => 0, 'answer' => '1.5 cm' ) );
        $st->execute( array( 'id_question' => 12, 'is_true' => 0, 'answer' => '2 cm' ) );
        $st->execute( array( 'id_question' => 13, 'is_true' => 1, 'answer' => 'pascalov' ) );
        $st->execute( array( 'id_question' => 14, 'is_true' => 0, 'answer' => 'Turingovi' ) );
        $st->execute( array( 'id_question' => 14, 'is_true' => 0, 'answer' => 'Boolovi' ) );
        $st->execute( array( 'id_question' => 14, 'is_true' => 1, 'answer' => 'Vennovi' ) );
        $st->execute( array( 'id_question' => 14, 'is_true' => 0, 'answer' => 'Giblinovi' ) );
        $st->execute( array( 'id_question' => 15, 'is_true' => 1, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 15, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 16, 'is_true' => 1, 'answer' => 'Cibalia' ) );
        $st->execute( array( 'id_question' => 16, 'is_true' => 0, 'answer' => 'Sesvete' ) );
        $st->execute( array( 'id_question' => 16, 'is_true' => 0, 'answer' => 'Kustošija' ) );
        $st->execute( array( 'id_question' => 16, 'is_true' => 0, 'answer' => 'Dinamo II' ) );
        $st->execute( array( 'id_question' => 17, 'is_true' => 1, 'answer' => 'tim henman' ) );
        $st->execute( array( 'id_question' => 18, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 18, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 19, 'is_true' => 1, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 19, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 20, 'is_true' => 1, 'answer' => 'Zdravko Zovko' ) );
        $st->execute( array( 'id_question' => 20, 'is_true' => 0, 'answer' => 'Lino Červar' ) );
        $st->execute( array( 'id_question' => 20, 'is_true' => 0, 'answer' => 'Slavko Goluža' ) );
        $st->execute( array( 'id_question' => 20, 'is_true' => 0, 'answer' => 'Željko Tomac' ) );
        $st->execute( array( 'id_question' => 21, 'is_true' => 1, 'answer' => 'Belgija' ) );
        $st->execute( array( 'id_question' => 21, 'is_true' => 0, 'answer' => 'Francuska' ) );
        $st->execute( array( 'id_question' => 21, 'is_true' => 0, 'answer' => 'Španjolska' ) );
        $st->execute( array( 'id_question' => 21, 'is_true' => 0, 'answer' => 'Italija' ) );
        $st->execute( array( 'id_question' => 22, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 22, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 23, 'is_true' => 1, 'answer' => 'sevilla' ) );
        $st->execute( array( 'id_question' => 24, 'is_true' => 1, 'answer' => 'phoenix suns' ) );
        $st->execute( array( 'id_question' => 25, 'is_true' => 1, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 25, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 26, 'is_true' => 0, 'answer' => '30' ) );
        $st->execute( array( 'id_question' => 26, 'is_true' => 1, 'answer' => '35' ) );
        $st->execute( array( 'id_question' => 26, 'is_true' => 0, 'answer' => '40' ) );
        $st->execute( array( 'id_question' => 26, 'is_true' => 0, 'answer' => '45' ) );
        $st->execute( array( 'id_question' => 27, 'is_true' => 0, 'answer' => 'Zagreb' ) );
        $st->execute( array( 'id_question' => 27, 'is_true' => 1, 'answer' => 'Varaždin' ) );
        $st->execute( array( 'id_question' => 27, 'is_true' => 0, 'answer' => 'Osijek' ) );
        $st->execute( array( 'id_question' => 27, 'is_true' => 0, 'answer' => 'Karlovac' ) );
        $st->execute( array( 'id_question' => 28, 'is_true' => 1, 'answer' => 'eintracht frankfurt' ) );
        $st->execute( array( 'id_question' => 29, 'is_true' => 1, 'answer' => 'Anton' ) );
        $st->execute( array( 'id_question' => 29, 'is_true' => 0, 'answer' => 'Šimun' ) );
        $st->execute( array( 'id_question' => 29, 'is_true' => 0, 'answer' => 'Marko' ) );
        $st->execute( array( 'id_question' => 29, 'is_true' => 0, 'answer' => 'Andrija' ) );
        $st->execute( array( 'id_question' => 30, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 30, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 31, 'is_true' => 1, 'answer' => 'one' ) );
        $st->execute( array( 'id_question' => 32, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 32, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 33, 'is_true' => 1, 'answer' => 'scream' ) );
        $st->execute( array( 'id_question' => 34, 'is_true' => 1, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 34, 'is_true' => 0, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 35, 'is_true' => 0, 'answer' => 'prvi' ) );
        $st->execute( array( 'id_question' => 35, 'is_true' => 0, 'answer' => 'treći' ) );
        $st->execute( array( 'id_question' => 35, 'is_true' => 1, 'answer' => 'peti' ) );
        $st->execute( array( 'id_question' => 35, 'is_true' => 0, 'answer' => 'sedmi' ) );
        $st->execute( array( 'id_question' => 36, 'is_true' => 1, 'answer' => 'švedska' ) );
        $st->execute( array( 'id_question' => 37, 'is_true' => 1, 'answer' => 'cafe del mar' ) );
        $st->execute( array( 'id_question' => 38, 'is_true' => 1, 'answer' => 'maurice ravel' ) );
        $st->execute( array( 'id_question' => 39, 'is_true' => 1, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 39, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 40, 'is_true' => 1, 'answer' => 'ten' ) );
        $st->execute( array( 'id_question' => 41, 'is_true' => 1, 'answer' => 'one-hit wonder' ) );
        $st->execute( array( 'id_question' => 41, 'is_true' => 0, 'answer' => 'two-hit thunder' ) );
        $st->execute( array( 'id_question' => 41, 'is_true' => 0, 'answer' => 'shooting star' ) );
        $st->execute( array( 'id_question' => 41, 'is_true' => 0, 'answer' => 'space shuttle ' ) );
        $st->execute( array( 'id_question' => 42, 'is_true' => 1, 'answer' => 'josip runjanin' ) );
        $st->execute( array( 'id_question' => 43, 'is_true' => 1, 'answer' => 'N' ) );
        $st->execute( array( 'id_question' => 43, 'is_true' => 0, 'answer' => 'T' ) );
        $st->execute( array( 'id_question' => 44, 'is_true' => 1, 'answer' => 'sam smith' ) );
        $st->execute( array( 'id_question' => 45, 'is_true' => 0, 'answer' => 'death' ) );
        $st->execute( array( 'id_question' => 45, 'is_true' => 0, 'answer' => 'glam' ) );
        $st->execute( array( 'id_question' => 45, 'is_true' => 0, 'answer' => 'doom' ) );
        $st->execute( array( 'id_question' => 45, 'is_true' => 1, 'answer' => 'thrash' ) );
        $st->execute( array( 'id_question' => 46, 'is_true' => 0, 'answer' => 'glasno' ) );
        $st->execute( array( 'id_question' => 46, 'is_true' => 1, 'answer' => 'na usta' ) );
        $st->execute( array( 'id_question' => 46, 'is_true' => 0, 'answer' => 'na nos' ) );
        $st->execute( array( 'id_question' => 46, 'is_true' => 0, 'answer' => 'sporo' ) );
        $st->execute( array( 'id_question' => 47, 'is_true' => 1, 'answer' => 'ebbinga' ) );
        $st->execute( array( 'id_question' => 48, 'is_true' => 1, 'answer' => 'Ratatouille' ) );
        $st->execute( array( 'id_question' => 49, 'is_true' => 1, 'answer' => 'lego' ) );
        $st->execute( array( 'id_question' => 50, 'is_true' => 1, 'answer' => 'morgan freeman' ) );
        $st->execute( array( 'id_question' => 51, 'is_true' => 1, 'answer' => 'Kevin Bacon' ) );
        $st->execute( array( 'id_question' => 51, 'is_true' => 0, 'answer' => 'Morgan Freeman ' ) );
        $st->execute( array( 'id_question' => 51, 'is_true' => 0, 'answer' => 'Brad Pitt' ) );
        $st->execute( array( 'id_question' => 51, 'is_true' => 0, 'answer' => 'Danny De Vito' ) );
        $st->execute( array( 'id_question' => 52, 'is_true' => 0, 'answer' => 'Frozone' ) );
        $st->execute( array( 'id_question' => 52, 'is_true' => 0, 'answer' => 'Syndrom' ) );
        $st->execute( array( 'id_question' => 52, 'is_true' => 0, 'answer' => 'Mirage' ) );
        $st->execute( array( 'id_question' => 52, 'is_true' => 1, 'answer' => 'Mr. Incredible' ) );
        $st->execute( array( 'id_question' => 53, 'is_true' => 1, 'answer' => 'castle rock' ) );
        $st->execute( array( 'id_question' => 54, 'is_true' => 1, 'answer' => 'game of thrones' ) );
        $st->execute( array( 'id_question' => 55, 'is_true' => 0, 'answer' => '5.000km' ) );
        $st->execute( array( 'id_question' => 55, 'is_true' => 1, 'answer' => '10.000km' ) );
        $st->execute( array( 'id_question' => 55, 'is_true' => 0, 'answer' => '15.000km' ) );
        $st->execute( array( 'id_question' => 55, 'is_true' => 0, 'answer' => '20.000km' ) );
        $st->execute( array( 'id_question' => 56, 'is_true' => 1, 'answer' => 'Svaki dan ' ) );
        $st->execute( array( 'id_question' => 56, 'is_true' => 0, 'answer' => 'Nikada' ) );
        $st->execute( array( 'id_question' => 56, 'is_true' => 0, 'answer' => 'Možda' ) );
        $st->execute( array( 'id_question' => 56, 'is_true' => 0, 'answer' => 'Nije' ) );
        $st->execute( array( 'id_question' => 57, 'is_true' => 1, 'answer' => 'lavina' ) );
        $st->execute( array( 'id_question' => 58, 'is_true' => 0, 'answer' => 'Lijep život' ) );
        $st->execute( array( 'id_question' => 58, 'is_true' => 0, 'answer' => 'Profesor' ) );
        $st->execute( array( 'id_question' => 58, 'is_true' => 1, 'answer' => 'Velika ljepota' ) );
        $st->execute( array( 'id_question' => 58, 'is_true' => 0, 'answer' => 'Pinocchio' ) );
        $st->execute( array( 'id_question' => 59, 'is_true' => 1, 'answer' => 'scranton' ) );
        $st->execute( array( 'id_question' => 60, 'is_true' => 0, 'answer' => 'Sherlock Holmes,' ) );
        $st->execute( array( 'id_question' => 60, 'is_true' => 0, 'answer' => 'Hercule Poirot' ) );
        $st->execute( array( 'id_question' => 60, 'is_true' => 0, 'answer' => 'Del Boy Trotter' ) );
        $st->execute( array( 'id_question' => 60, 'is_true' => 1, 'answer' => 'James Bond' ) );
                            
    }
    catch( PDOException $e ) { exit( "PDO error [kviz_odgovori]: " . $e->getMessage() ); }

    echo "Ubacio u tablicu kviz_odgovori.<br />";
}

?> 
 
 
