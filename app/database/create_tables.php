<?php


require_once __DIR__ . '/db.class.php';

create_table_korisnici();
create_table_kvizovi();
create_table_tipovi();
create_table_pitanja();
create_table_odgovori();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->query( 'SELECT DATABASE()' );
		$dbname = $st->fetch()[0];

		$st = $db->prepare( 
			'SELECT * FROM information_schema.tables WHERE table_schema = :dbname AND table_name = :tblname LIMIT 1' );
		$st->execute( ['dbname' => $dbname, 'tblname' => $tblname] );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_korisnici()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_korisnici' ) )
		exit( 'Tablica kviz_korisnici vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_korisnici (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'is_admin int,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_korisnici]: " . $e->getMessage() ); }

	echo "Napravio tablicu kviz_korisnici.<br />";
}


function create_table_kvizovi()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_kvizovi' ) )
		exit( 'Tablica kviz_kvizovi vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_kvizovi (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'name varchar(100) NOT NULL,' .
            'is_type1 int,' .
            'is_type2 int,' .
            'is_type3 int )'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_kvizovi]: " . $e->getMessage() ); }

	echo "Napravio tablicu kviz_kvizovi.<br />";
}


function create_table_tipovi()
{
    $db = DB::getConnection();

    if( has_table( 'kviz_tipovi' ) )
        exit( 'Tablica kviz_tipovi vec postoji. Obrisite ju pa probajte ponovno.' );

    try
    {
        $st = $db->prepare(
            'CREATE TABLE IF NOT EXISTS kviz_tipovi (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'name varchar(100) NOT NULL)'
        );

        $st->execute();
    }
    catch( PDOException $e ) { exit( "PDO error [create kviz_tipovi]: " . $e->getMessage() ); }

    echo "Napravio tablicu kviz_tipovi.<br />";
}


function create_table_pitanja()
{
    $db = DB::getConnection();

    if( has_table( 'kviz_pitanja' ) )
        exit( 'Tablica kviz_pitanja vec postoji. Obrisite ju pa probajte ponovno.' );

    try
    {
        $st = $db->prepare(
            'CREATE TABLE IF NOT EXISTS kviz_pitanja (' .
            'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_quiz int NOT NULL,' .
            'id_type int NOT NULL,' .
            'question varchar(1000) NOT NULL)'
        );

        $st->execute();
    }
    catch( PDOException $e ) { exit( "PDO error [create kviz_pitanja]: " . $e->getMessage() ); }

    echo "Napravio tablicu kviz_pitanja.<br />";
}

function create_table_odgovori()
{
	$db = DB::getConnection();

	if( has_table( 'kviz_odgovori' ) )
		exit( 'Tablica kviz_odgovori vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS kviz_odgovori (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_question INT NOT NULL,' .
            'is_true int,' .
			'answer varchar(1000))'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create kviz_odgovori]: " . $e->getMessage() ); }

	echo "Napravio tablicu kviz_odgovori.<br />";
}

?> 
