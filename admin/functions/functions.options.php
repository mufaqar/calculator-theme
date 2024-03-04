<?php
add_action('init', 'of_options');

if (!function_exists('of_options'))
	{
	function of_options()
		{

		// Access the WordPress Categories via an Array

		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach($of_categories_obj as $of_cat)
			{
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
			}

		$categories_tmp = array_unshift($of_categories, "Select a category:");

		// Access the WordPress Pages via an Array

		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		foreach($of_pages_obj as $of_page)
			{
			$of_pages[$of_page->ID] = $of_page->post_name;
			}

		$of_pages_tmp = array_unshift($of_pages, "Select a page:");
		
		
		$google_fonts = array(
							"" => "",
							"Abel" => "Abel",
							"Abril Fatface" => "Abril Fatface",
							"Aclonica" => "Aclonica",
							"Acme" => "Acme",
							"Actor" => "Actor",
							"Adamina" => "Adamina",
							"Advent Pro" => "Advent Pro",
							"Aguafina Script" => "Aguafina Script",
							"Aladin" => "Aladin",
							"Aldrich" => "Aldrich",
							"Alegreya" => "Alegreya",
							"Alegreya SC" => "Alegreya SC",
							"Alex Brush" => "Alex Brush",
							"Alfa Slab One" => "Alfa Slab One",
							"Alice" => "Alice",
							"Alike" => "Alike",
							"Alike Angular" => "Alike Angular",
							"Allan" => "Allan",
							"Allerta" => "Allerta",
							"Allerta Stencil" => "Allerta Stencil",
							"Allura" => "Allura",
							"Almendra" => "Almendra",
							"Almendra SC" => "Almendra SC",
							"Amaranth" => "Amaranth",
							"Amatic SC" => "Amatic SC",
							"Amethysta" => "Amethysta",
							"Andada" => "Andada",
							"Andika" => "Andika",
							"Angkor" => "Angkor",
							"Annie Use Your Telescope" => "Annie Use Your Telescope",
							"Anonymous Pro" => "Anonymous Pro",
							"Antic" => "Antic",
							"Antic Didone" => "Antic Didone",
							"Antic Slab" => "Antic Slab",
							"Anton" => "Anton",
							"Arapey" => "Arapey",
							"Arbutus" => "Arbutus",
							"Architects Daughter" => "Architects Daughter",
							"Arimo" => "Arimo",
							"Arizonia" => "Arizonia",
							"Armata" => "Armata",
							"Artifika" => "Artifika",
							"Arvo" => "Arvo",
							"Asap" => "Asap",
							"Asset" => "Asset",
							"Astloch" => "Astloch",
							"Asul" => "Asul",
							"Atomic Age" => "Atomic Age",
							"Aubrey" => "Aubrey",
							"Audiowide" => "Audiowide",
							"Average" => "Average",
							"Averia Gruesa Libre" => "Averia Gruesa Libre",
							"Averia Libre" => "Averia Libre",
							"Averia Sans Libre" => "Averia Sans Libre",
							"Averia Serif Libre" => "Averia Serif Libre",
							"Bad Script" => "Bad Script",
							"Balthazar" => "Balthazar",
							"Bangers" => "Bangers",
							"Basic" => "Basic",
							"Battambang" => "Battambang",
							"Baumans" => "Baumans",
							"Bayon" => "Bayon",
							"Belgrano" => "Belgrano",
							"Belleza" => "Belleza",
							"Bentham" => "Bentham",
							"Berkshire Swash" => "Berkshire Swash",
							"Bevan" => "Bevan",
							"Bigshot One" => "Bigshot One",
							"Bilbo" => "Bilbo",
							"Bilbo Swash Caps" => "Bilbo Swash Caps",
							"Bitter" => "Bitter",
							"Black Ops One" => "Black Ops One",
							"Bokor" => "Bokor",
							"Bonbon" => "Bonbon",
							"Boogaloo" => "Boogaloo",
							"Bowlby One" => "Bowlby One",
							"Bowlby One SC" => "Bowlby One SC",
							"Brawler" => "Brawler",
							"Bree Serif" => "Bree Serif",
							"Bubblegum Sans" => "Bubblegum Sans",
							"Buda" => "Buda",
							"Buenard" => "Buenard",
							"Butcherman" => "Butcherman",
							"Butterfly Kids" => "Butterfly Kids",
							"Cabin" => "Cabin",
							"Cabin Condensed" => "Cabin Condensed",
							"Cabin Sketch" => "Cabin Sketch",
							"Caesar Dressing" => "Caesar Dressing",
							"Cagliostro" => "Cagliostro",
							"Calligraffitti" => "Calligraffitti",
							"Cambo" => "Cambo",
							"Candal" => "Candal",
							"Cantarell" => "Cantarell",
							"Cantata One" => "Cantata One",
							"Cardo" => "Cardo",
							"Carme" => "Carme",
							"Carter One" => "Carter One",
							"Caudex" => "Caudex",
							"Cedarville Cursive" => "Cedarville Cursive",
							"Ceviche One" => "Ceviche One",
							"Changa One" => "Changa One",
							"Chango" => "Chango",
							"Chau Philomene One" => "Chau Philomene One",
							"Chelsea Market" => "Chelsea Market",
							"Chenla" => "Chenla",
							"Cherry Cream Soda" => "Cherry Cream Soda",
							"Chewy" => "Chewy",
							"Chicle" => "Chicle",
							"Chivo" => "Chivo",
							"Coda" => "Coda",
							"Coda Caption" => "Coda Caption",
							"Codystar" => "Codystar",
							"Comfortaa" => "Comfortaa",
							"Coming Soon" => "Coming Soon",
							"Concert One" => "Concert One",
							"Condiment" => "Condiment",
							"Content" => "Content",
							"Contrail One" => "Contrail One",
							"Convergence" => "Convergence",
							"Cookie" => "Cookie",
							"Copse" => "Copse",
							"Corben" => "Corben",
							"Cousine" => "Cousine",
							"Coustard" => "Coustard",
							"Covered By Your Grace" => "Covered By Your Grace",
							"Crafty Girls" => "Crafty Girls",
							"Creepster" => "Creepster",
							"Crete Round" => "Crete Round",
							"Crimson Text" => "Crimson Text",
							"Crushed" => "Crushed",
							"Cuprum" => "Cuprum",
							"Cutive" => "Cutive",
							"Damion" => "Damion",
							"Dancing Script" => "Dancing Script",
							"Dangrek" => "Dangrek",
							"Dawning of a New Day" => "Dawning of a New Day",
							"Days One" => "Days One",
							"Delius" => "Delius",
							"Delius Swash Caps" => "Delius Swash Caps",
							"Delius Unicase" => "Delius Unicase",
							"Della Respira" => "Della Respira",
							"Devonshire" => "Devonshire",
							"Didact Gothic" => "Didact Gothic",
							"Diplomata" => "Diplomata",
							"Diplomata SC" => "Diplomata SC",
							"Doppio One" => "Doppio One",
							"Dorsa" => "Dorsa",
							"Dosis" => "Dosis",
							"Dr Sugiyama" => "Dr Sugiyama",
							"Droid Sans" => "Droid Sans",
							"Droid Sans Mono" => "Droid Sans Mono",
							"Droid Serif" => "Droid Serif",
							"Duru Sans" => "Duru Sans",
							"Dynalight" => "Dynalight",
							"EB Garamond" => "EB Garamond",
							"Eater" => "Eater",
							"Economica" => "Economica",
							"Electrolize" => "Electrolize",
							"Emblema One" => "Emblema One",
							"Emilys Candy" => "Emilys Candy",
							"Engagement" => "Engagement",
							"Enriqueta" => "Enriqueta",
							"Erica One" => "Erica One",
							"Esteban" => "Esteban",
							"Euphoria Script" => "Euphoria Script",
							"Ewert" => "Ewert",
							"Exo" => "Exo",
							"Expletus Sans" => "Expletus Sans",
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
							"Federant" => "Federant",
							"Federo" => "Federo",
							"Felipa" => "Felipa",
							"Fjord One" => "Fjord One",
							"Flamenco" => "Flamenco",
							"Flavors" => "Flavors",
							"Fondamento" => "Fondamento",
							"Fontdiner Swanky" => "Fontdiner Swanky",
							"Forum" => "Forum",
							"Francois One" => "Francois One",
							"Fredericka the Great" => "Fredericka the Great",
							"Fredoka One" => "Fredoka One",
							"Freehand" => "Freehand",
							"Fresca" => "Fresca",
							"Frijole" => "Frijole",
							"Fugaz One" => "Fugaz One",
							"GFS Didot" => "GFS Didot",
							"GFS Neohellenic" => "GFS Neohellenic",
							"Galdeano" => "Galdeano",
							"Gentium Basic" => "Gentium Basic",
							"Gentium Book Basic" => "Gentium Book Basic",
							"Geo" => "Geo",
							"Geostar" => "Geostar",
							"Geostar Fill" => "Geostar Fill",
							"Germania One" => "Germania One",
							"Give You Glory" => "Give You Glory",
							"Glass Antiqua" => "Glass Antiqua",
							"Glegoo" => "Glegoo",
							"Gloria Hallelujah" => "Gloria Hallelujah",
							"Goblin One" => "Goblin One",
							"Gochi Hand" => "Gochi Hand",
							"Gorditas" => "Gorditas",
							"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
							"Graduate" => "Graduate",
							"Gravitas One" => "Gravitas One",
							"Great Vibes" => "Great Vibes",
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
							"Henny Penny" => "Henny Penny",
							"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
							"Holtwood One SC" => "Holtwood One SC",
							"Homemade Apple" => "Homemade Apple",
							"Homenaje" => "Homenaje",
							"IM Fell DW Pica" => "IM Fell DW Pica",
							"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
							"IM Fell Double Pica" => "IM Fell Double Pica",
							"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
							"IM Fell English" => "IM Fell English",
							"IM Fell English SC" => "IM Fell English SC",
							"IM Fell French Canon" => "IM Fell French Canon",
							"IM Fell French Canon SC" => "IM Fell French Canon SC",
							"IM Fell Great Primer" => "IM Fell Great Primer",
							"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
							"Iceberg" => "Iceberg",
							"Iceland" => "Iceland",
							"Imprima" => "Imprima",
							"Inconsolata" => "Inconsolata",
							"Inder" => "Inder",
							"Indie Flower" => "Indie Flower",
							"Inika" => "Inika",
							"Irish Grover" => "Irish Grover",
							"Istok Web" => "Istok Web",
							"Italiana" => "Italiana",
							"Italianno" => "Italianno",
							"Jim Nightshade" => "Jim Nightshade",
							"Jockey One" => "Jockey One",
							"Jolly Lodger" => "Jolly Lodger",
							"Josefin Sans" => "Josefin Sans",
							"Josefin Slab" => "Josefin Slab",
							"Judson" => "Judson",
							"Julee" => "Julee",
							"Junge" => "Junge",
							"Jura" => "Jura",
							"Just Another Hand" => "Just Another Hand",
							"Just Me Again Down Here" => "Just Me Again Down Here",
							"Kameron" => "Kameron",
							"Karla" => "Karla",
							"Kaushan Script" => "Kaushan Script",
							"Kelly Slab" => "Kelly Slab",
							"Kenia" => "Kenia",
							"Khmer" => "Khmer",
							"Knewave" => "Knewave",
							"Kotta One" => "Kotta One",
							"Koulen" => "Koulen",
							"Kranky" => "Kranky",
							"Kreon" => "Kreon",
							"Kristi" => "Kristi",
							"Krona One" => "Krona One",
							"La Belle Aurore" => "La Belle Aurore",
							"Lancelot" => "Lancelot",
							"Lato" => "Lato",
							"League Script" => "League Script",
							"Leckerli One" => "Leckerli One",
							"Ledger" => "Ledger",
							"Lekton" => "Lekton",
							"Lemon" => "Lemon",
							"Lilita One" => "Lilita One",
							"Limelight" => "Limelight",
							"Linden Hill" => "Linden Hill",
							"Lobster" => "Lobster",
							"Lobster Two" => "Lobster Two",
							"Londrina Outline" => "Londrina Outline",
							"Londrina Shadow" => "Londrina Shadow",
							"Londrina Sketch" => "Londrina Sketch",
							"Londrina Solid" => "Londrina Solid",
							"Lora" => "Lora",
							"Love Ya Like A Sister" => "Love Ya Like A Sister",
							"Loved by the King" => "Loved by the King",
							"Lovers Quarrel" => "Lovers Quarrel",
							"Luckiest Guy" => "Luckiest Guy",
							"Lusitana" => "Lusitana",
							"Lustria" => "Lustria",
							"Macondo" => "Macondo",
							"Macondo Swash Caps" => "Macondo Swash Caps",
							"Magra" => "Magra",
							"Maiden Orange" => "Maiden Orange",
							"Mako" => "Mako",
							"Marck Script" => "Marck Script",
							"Marko One" => "Marko One",
							"Marmelad" => "Marmelad",
							"Marvel" => "Marvel",
							"Mate" => "Mate",
							"Mate SC" => "Mate SC",
							"Maven Pro" => "Maven Pro",
							"Meddon" => "Meddon",
							"MedievalSharp" => "MedievalSharp",
							"Medula One" => "Medula One",
							"Megrim" => "Megrim",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Metal" => "Metal",
							"Metamorphous" => "Metamorphous",
							"Metrophobic" => "Metrophobic",
							"Michroma" => "Michroma",
							"Miltonian" => "Miltonian",
							"Miltonian Tattoo" => "Miltonian Tattoo",
							"Miniver" => "Miniver",
							"Miss Fajardose" => "Miss Fajardose",
							"Modern Antiqua" => "Modern Antiqua",
							"Molengo" => "Molengo",
							"Monofett" => "Monofett",
							"Monoton" => "Monoton",
							"Monsieur La Doulaise" => "Monsieur La Doulaise",
							"Montaga" => "Montaga",
							"Montez" => "Montez",
							"Montserrat" => "Montserrat",
							"Moul" => "Moul",
							"Moulpali" => "Moulpali",
							"Mountains of Christmas" => "Mountains of Christmas",
							"Mr Bedfort" => "Mr Bedfort",
							"Mr Dafoe" => "Mr Dafoe",
							"Mr De Haviland" => "Mr De Haviland",
							"Mrs Saint Delafield" => "Mrs Saint Delafield",
							"Mrs Sheppards" => "Mrs Sheppards",
							"Muli" => "Muli",
							"Mystery Quest" => "Mystery Quest",
							"Neucha" => "Neucha",
							"Neuton" => "Neuton",
							"News Cycle" => "News Cycle",
							"Niconne" => "Niconne",
							"Nixie One" => "Nixie One",
							"Nobile" => "Nobile",
							"Nokora" => "Nokora",
							"Norican" => "Norican",
							"Nosifer" => "Nosifer",
							"Nothing You Could Do" => "Nothing You Could Do",
							"Noticia Text" => "Noticia Text",
							"Nova Cut" => "Nova Cut",
							"Nova Flat" => "Nova Flat",
							"Nova Mono" => "Nova Mono",
							"Nova Oval" => "Nova Oval",
							"Nova Round" => "Nova Round",
							"Nova Script" => "Nova Script",
							"Nova Slim" => "Nova Slim",
							"Nova Square" => "Nova Square",
							"Numans" => "Numans",
							"Nunito" => "Nunito",
							"Odor Mean Chey" => "Odor Mean Chey",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Open Sans" => "Open Sans",
							"Open Sans Condensed" => "Open Sans Condensed",
							"Orbitron" => "Orbitron",
							"Original Surfer" => "Original Surfer",
							"Oswald" => "Oswald",
							"Over the Rainbow" => "Over the Rainbow",
							"Overlock" => "Overlock",
							"Overlock SC" => "Overlock SC",
							"Ovo" => "Ovo",
							"Oxygen" => "Oxygen",
							"PT Mono" => "PT Mono",
							"PT Sans" => "PT Sans",
							"PT Sans Caption" => "PT Sans Caption",
							"PT Sans Narrow" => "PT Sans Narrow",
							"PT Serif" => "PT Serif",
							"PT Serif Caption" => "PT Serif Caption",
							"Pacifico" => "Pacifico",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Permanent Marker" => "Permanent Marker",
							"Petrona" => "Petrona",
							"Philosopher" => "Philosopher",
							"Piedra" => "Piedra",
							"Pinyon Script" => "Pinyon Script",
							"Plaster" => "Plaster",
							"Play" => "Play",
							"Playball" => "Playball",
							"Playfair Display" => "Playfair Display",
							"Podkova" => "Podkova",
							"Poiret One" => "Poiret One",
							"Poller One" => "Poller One",
							"Poly" => "Poly",
							"Pompiere" => "Pompiere",
							"Pontano Sans" => "Pontano Sans",
							"Port Lligat Sans" => "Port Lligat Sans",
							"Port Lligat Slab" => "Port Lligat Slab",
							"Prata" => "Prata",
							"Preahvihear" => "Preahvihear",
							"Press Start 2P" => "Press Start 2P",
							"Princess Sofia" => "Princess Sofia",
							"Prociono" => "Prociono",
							"Prosto One" => "Prosto One",
							"Puritan" => "Puritan",
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Qwigley" => "Qwigley",
							"Roboto" => "Roboto",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Rammetto One" => "Rammetto One",
							"Rancho" => "Rancho",
							"Rationale" => "Rationale",
							"Redressed" => "Redressed",
							"Reenie Beanie" => "Reenie Beanie",
							"Revalia" => "Revalia",
							"Ribeye" => "Ribeye",
							"Ribeye Marrow" => "Ribeye Marrow",
							"Righteous" => "Righteous",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
							"Ropa Sans" => "Ropa Sans",
							"Rosario" => "Rosario",
							"Rosarivo" => "Rosarivo",
							"Rouge Script" => "Rouge Script",
							"Ruda" => "Ruda",
							"Ruge Boogie" => "Ruge Boogie",
							"Ruluko" => "Ruluko",
							"Ruslan Display" => "Ruslan Display",
							"Russo One" => "Russo One",
							"Ruthie" => "Ruthie",
							"Sail" => "Sail",
							"Salsa" => "Salsa",
							"Sancreek" => "Sancreek",
							"Sansita One" => "Sansita One",
							"Sarina" => "Sarina",
							"Satisfy" => "Satisfy",
							"Schoolbell" => "Schoolbell",
							"Seaweed Script" => "Seaweed Script",
							"Sevillana" => "Sevillana",
							"Shadows Into Light" => "Shadows Into Light",
							"Shadows Into Light Two" => "Shadows Into Light Two",
							"Shanti" => "Shanti",
							"Share" => "Share",
							"Shojumaru" => "Shojumaru",
							"Short Stack" => "Short Stack",
							"Siemreap" => "Siemreap",
							"Sigmar One" => "Sigmar One",
							"Signika" => "Signika",
							"Signika Negative" => "Signika Negative",
							"Simonetta" => "Simonetta",
							"Sirin Stencil" => "Sirin Stencil",
							"Six Caps" => "Six Caps",
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
							"Special Elite" => "Special Elite",
							"Spicy Rice" => "Spicy Rice",
							"Spinnaker" => "Spinnaker",
							"Spirax" => "Spirax",
							"Squada One" => "Squada One",
							"Stardos Stencil" => "Stardos Stencil",
							"Stint Ultra Condensed" => "Stint Ultra Condensed",
							"Stint Ultra Expanded" => "Stint Ultra Expanded",
							"Stoke" => "Stoke",
							"Sue Ellen Francisco" => "Sue Ellen Francisco",
							"Sunshiney" => "Sunshiney",
							"Supermercado One" => "Supermercado One",
							"Suwannaphum" => "Suwannaphum",
							"Swanky and Moo Moo" => "Swanky and Moo Moo",
							"Syncopate" => "Syncopate",
							"Tangerine" => "Tangerine",
							"Taprom" => "Taprom",
							"Telex" => "Telex",
							"Tenor Sans" => "Tenor Sans",
							"The Girl Next Door" => "The Girl Next Door",
							"Tienne" => "Tienne",
							"Tinos" => "Tinos",
							"Titan One" => "Titan One",
							"Trade Winds" => "Trade Winds",
							"Trocchi" => "Trocchi",
							"Trochut" => "Trochut",
							"Trykker" => "Trykker",
							"Tulpen One" => "Tulpen One",
							"Ubuntu" => "Ubuntu",
							"Ubuntu Condensed" => "Ubuntu Condensed",
							"Ubuntu Mono" => "Ubuntu Mono",
							"Ultra" => "Ultra",
							"Uncial Antiqua" => "Uncial Antiqua",
							"UnifrakturCook" => "UnifrakturCook",
							"UnifrakturMaguntia" => "UnifrakturMaguntia",
							"Unkempt" => "Unkempt",
							"Unlock" => "Unlock",
							"Unna" => "Unna",
							"VT323" => "VT323",
							"Varela" => "Varela",
							"Varela Round" => "Varela Round",
							"Vast Shadow" => "Vast Shadow",
							"Vibur" => "Vibur",
							"Vidaloka" => "Vidaloka",
							"Viga" => "Viga",
							"Voces" => "Voces",
							"Volkhov" => "Volkhov",
							"Vollkorn" => "Vollkorn",
							"Voltaire" => "Voltaire",
							"Waiting for the Sunrise" => "Waiting for the Sunrise",
							"Wallpoet" => "Wallpoet",
							"Walter Turncoat" => "Walter Turncoat",
							"Wellfleet" => "Wellfleet",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada",
						);

		$home_layout_block = array(
			"disabled" => array(
				"placebo" => "placebo", //REQUIRED!
			) ,
			"enabled" => array(
				"placebo" => "placebo", //REQUIRED!
				"block_top_banner" => "Top Banner",
				"block_reviews" => "Reviews",
				"block_feature_post" => "Features",
				"block_page_content" => "Page Content",
				"block_faq" => "FAQs",
				"block_about_me" => "About Author",
				"block_blog_posts" => "Blog Posts",
				"block_footer_banner" => "Footer Banner"
			) ,
		);

		// Stylesheets Reader

		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		if (is_dir($alt_stylesheet_path))
			{
			if ($alt_stylesheet_dir = opendir($alt_stylesheet_path))
				{
				while (($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false)
					{
					if (stristr($alt_stylesheet_file, ".css") !== false)
						{
						$alt_stylesheets[] = $alt_stylesheet_file;
						}
					}
				}
			}

		// More Options

		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array(
			"Select a number:",
			"1",
			"2",
			"3",
			"4",
			"5",
			"6",
			"7",
			"8",
			"9",
			"10",
			"11",
			"12",
			"13",
			"14",
			"15",
			"16",
			"17",
			"18",
			"19"
		);
		$body_repeat = array(
			"no-repeat",
			"repeat-x",
			"repeat-y",
			"repeat"
		);
		$body_pos = array(
			"top left",
			"top center",
			"top right",
			"center left",
			"center center",
			"center right",
			"bottom left",
			"bottom center",
			"bottom right"
		);

		// Image Alignment radio box

		$of_options_thumb_align = array(
			"alignleft" => "Left",
			"alignright" => "Right",
			"aligncenter" => "Center"
		);

		// Image Links to Options

		$of_options_image_link_to = array(
			"image" => "The Image",
			"post" => "The Post"
		);
		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Set the Options Array

		global $of_options;
		$of_options = array();
		$url = ADMIN_DIR . 'assets/images/';
		$defaultimagespath = get_template_directory_uri();

		// Home Page Options

		$of_options[] = array(
			"name"   => __( "Home Page", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),			
			"id" => "introduction",
			"std" => "Options for \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			"name"   => __( "Home Page Layout", 'author-ts' ),
			"desc"  => __( "Drag &amp; Drop layout manager for home page. Each item represents a section on home page. Simply drag the items up and down to adjust the layout. To disable a section drag it to left. Before you can see it on home page you must create a page and apply \"Home Page Template\" to it.", 'author-ts' ),
			"id" => "author_layout_manager",
			"std" => $home_layout_block,
			"type" => "sorter"
		);
		
		// Color Scheme Options

		$of_options[] = array(
			"name"   => __( "Colors and Styles", 'author-ts' ),
			"type" => "heading"
		);
		
	
				
		
													
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),			
			"id" => "styling_info",
			"std" => "Options for theme color scheme and custom CSS styles.",
			"icon" => true,
			"type" => "info"
		);	
		
		$of_options[] = array(
			"name"   => __( "Color Scheme", 'author-ts' ),
			"desc"  => __( "Pick a color scheme for your website. <br />(default: #10916b)", 'author-ts' ),
			"id" => "author_color_scheme",
			"std" => "#10916b",
			"type" => "color"
		);
		
		$of_options[] = array(
			"name"   => __( "Buttons Color", 'author-ts' ),
			"desc"  => __( "Pick a color for buttons. <br />(default: #f1bf12)", 'author-ts' ),
			"id" => "author_button_color",
			"std" => "#f1bf12",
			"type" => "color"
		);
		
		$of_options[] = array(
			'id' => 'author_custom_css',
			'type' => 'textarea',
			'name' => 'Custom CSS',
			'desc'   => __( 'You can paste css styles here to override theme styling.','author-ts' ),
			'std' => ''
		);

	// Font Options

		$of_options[] = array(
			"name"   => __( "Fonts", 'author-ts' ),
			"type" => "heading"
		);
		
			$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "styling_info",
			"std" => "Options for theme fonts and font sizes.",
			"icon" => true,
			"type" => "info"
		);	
		
		$of_options[] = array( "name"   => __( "Body Font Family", 'author-ts' ),
					"desc"  => __( "Regular body text font. <br />(default: Roboto)", 'author-ts' ),
					"id" => "body_fonts_family",
					"std" => "Roboto",
					"type" => "select",
					"options" => $google_fonts);


		$of_options[] = 
					array( 
					'name'    => __( "Body Font Size", 'author-ts' ),
					"desc"  => __( "Font size for regular body text. <br />(default: 16px)", 'author-ts' ),
					"id" => "author_body_font_size",
					"std" => array('size' => '17px'),
					"type" => "typography");	
					
		
		$of_options[] = array( "name"   => __( "Heading Font Family", 'author-ts' ),
					"desc"  => __( "Regular headings font. <br />(default: Bitter)", 'author-ts' ),
					"id" => "heading_fonts",
					"std" => "Bitter",
					"type" => "select",
					"options" => $google_fonts);
					
					
		$of_options[] = 
					array( 
					'name'    => __( "Heading 1 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H1 and similar headings. <br />(default: 36px)", 'author-ts' ),
					"id" => "author_h1_font_size",
					"std" => array('size' => '36px'),
					"type" => "typography");								
		
		
		$of_options[] = 
					array( 
					'name'    => __( "Heading 2 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H2 and similar headings. <br />(default: 30px)", 'author-ts' ),
					"id" => "author_h2_font_size",
					"std" => array('size' => '30px'),
					"type" => "typography");								
					
					
		$of_options[] = 
					array( 
					'name'    => __( "Heading 3 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H3 and similar headings. <br />(default: 24px)", 'author-ts' ),
					"id" => "author_h3_font_size",
					"std" => array('size' => '24px'),
					"type" => "typography");
					
		$of_options[] = 
					array( 
					'name'    => __( "Heading 4 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H4 and similar headings. <br />(default: 20px)", 'author-ts' ),
					"id" => "author_h4_font_size",
					"std" => array('size' => '20px'),
					"type" => "typography");								

		$of_options[] = 
					array( 
					'name'    => __( "Heading 5 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H5 and similar headings. <br />(default: 18px)", 'author-ts' ),
					"id" => "author_h5_font_size",
					"std" => array('size' => '18px'),
					"type" => "typography");
					
		$of_options[] = 
					array( 
					'name'    => __( "Heading 6 Font Size", 'author-ts' ),
					"desc"  => __( "Font size for H6 and similar headings. <br />(default: 16px)", 'author-ts' ),
					"id" => "author_h6_font_size",
					"std" => array('size' => '16px'),
					"type" => "typography");								
								
					
	
		// Header Options

		$of_options[] = array(
			"name"   => __( "Header", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Website Header\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_logo',
			'type' => 'media',
			'name' => 'Logo',
			'desc'   => __( 'Upload your website logo.','author-ts' ),
			"std" => '' . $defaultimagespath . '/images/logo.png'
		);
		
		$of_options[] = array(
			'id' => 'author_favicon',
			'type' => 'media',
			'name' => 'Favicon',
			'desc'   => __( 'Upload your website favicon. This tiny icon appears in address or title bar of browsers. Size should be 16px by 16px exact.','author-ts' ),
			"std" => '' . $defaultimagespath . '/images/favicon.ico'
		);
		
		$of_options[] = array(
			'id' => 'author_appleicon',
			'type' => 'media',
			'name' => 'Apple Icon',
			'desc'   => __( 'Upload your Apple icon. This will appear on home screen and bookmarks. Size should be 120px by 120px exact.','author-ts' ),
			"std" => '' . $defaultimagespath . '/images/apple-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_androidicon',
			'type' => 'media',
			'name' => 'Android Icon',
			'desc'   => __( 'Upload your Apple icon. This will appear on home screen and bookmarks. Size should be 128px by 128px exact.','author-ts' ),
			"std" => '' . $defaultimagespath . '/images/android-icon.png'
		);
		
		$of_options[] = array( 
			"name"   => __( "Sticky Header", 'author-ts' ),
			"id" 		=> "author_sticky_header",
			"std" 		=> 1,
			"on" 		=> "Yes",
			"off" 		=> "No",
			"type" 		=> "switch",
			'desc'   => __( 'Do you want to the header to be sticky on scroll down.', 'author-ts' )
		);
		
		$of_options[] = array(
			'id' => 'author_custom_scripts_header',
			'type' => 'textarea',
			'name' => 'Custom Scripts',
			'desc'   => __( 'You can paste any custom scripts here that you want to load in header.','author-ts' ),
			'std' => ''
		);

		// Top Banner Options

		$of_options[] = array(
			"name"   => __( "Top Banner", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),

			"id" => "introduction",
			"std" => "Options for \"Top Banner Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			"name"   => __( "Banner Layout", 'author-ts' ),
			"desc"  => __( "Choose banner layout, Author Theme offers two layouts one is called \"Optin Form Layout\" and other is called \"Buy Now Layout\".", 'author-ts' ),
			"id" => "author_top_banner_layout",
			"std" => "t_b_l_1",
			"type" => "images",
			"options" => array(
				't_b_l_1' => $url . 'top-banner-optin.jpg',
				't_b_l_2' => $url . 'top-banner-buynow.jpg',
			)
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),	
			"id" => "introduction",
			"std" => "Following options belong to both layouts.",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_top_banner_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'You need a beautiful website for your book, Right?'
		);
		
		$of_options[] = array(
			'id' => 'author_top_banner_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Crafting a perfect website can be tough. Take advantage of the Author Theme.'
		);
		
		$of_options[] = array(
			'id' => 'author_top_banner_image',
			'type' => 'media',
			'name' => __('Book Cover', 'author_ts') ,
			'desc' => __('Upload book cover or image.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/book-cover.png'
		);
		
		$of_options[] = array(
			'id' => 'author_top_banner_pdf',
			'type' => 'media',
			"mod"		=> "min",
			'name' => __('Book Preview (PDF)', 'author_ts') ,
			'desc' => __('Upload book preview file. It must be in PDF format. Leave it blank to remove book preview.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/book-preview.pdf'
		);

		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "styling_info",
			"std" => "Following options are for \"Optin Form Layout\" only.",
			"icon" => true,
			"type" => "info"
		);	

		$of_options[] = array(
			'id' => 'author_tbo_heading',
			'type' => 'text',
			'name' => __('Optin Form  Heading', 'author_ts') ,
			'std' => 'Offer your readers a free chapter'
		);
		
		$of_options[] = array(
			'id' => 'author_tbo_sub_heading',
			'type' => 'textarea',
			'name' => __('Optin Form Text', 'author_ts') ,
			'std' => 'Everyone loves freebies. Offering a free chapter can be a great way to get people to signup to your email subscribers list. Make sure to put it above the fold for better conversion rate.'
		);
		
		$of_options[] = array(
			'id' => 'author_tbo_form',
			'type' => 'textarea',
			'name' => __('Optin Form Code', 'author_ts') ,
			'desc' => __('Code must be in HTML format. You can also use contact form shortcode here.') ,
			'std' => "<input type=\"text\" value=\"John Taylor\" class=\"wpcf7-text\" onfocus=\"if (this.value==this.defaultValue) this.value = ''\" onblur=\"if (this.value=='') this.value = this.defaultValue\" />
<input type=\"text\" value=\"john@website.com\" class=\"wpcf7-text\" onfocus=\"if (this.value==this.defaultValue) this.value = ''\" onblur=\"if (this.value=='') this.value = this.defaultValue\" />
<input type=\"submit\" value=\"Sign Up For a Free Chapter\" class=\"wpcf7-submit\" />"
		);
		
		$of_options[] = array(
			'id' => 'author_tbo_privacy',
			'type' => 'text',
			'name' => __('Privacy Statement', 'author_ts') ,
			'std' => 'Promise, we do not spam our awesome readers :)'
		);

		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "tbbn_info",
			"std" => "Following options are for \"Buy Now Layout\" only.",
			"icon" => true,
			"type" => "info"
		);	

		$of_options[] = array(
			'id' => 'author_tbb_heading',
			'type' => 'text',
			'name' => __('Buy Now Heading', 'author_ts') ,
			'std' => 'Showcase your book for purchase'
		);
		
		$of_options[] = array(
			'id' => 'author_tbb_sub_heading',
			'type' => 'textarea',
			'name' => __('Buy Now Text', 'author_ts') ,
			'std' => '<ul>
<li>Author Theme is fully SEO friendly, you will rank high in Google.</li>
<li>It comes with a highly customizeable theme options panel.</li>
<li>Author Theme comes with 12 built in custom WordPress widgets.</li>
<li>It is bundled with all common shortcodes that anyone may need.</li>
<li>Its responsive and will look equally good on all screen sizes.</li>
</ul>'
		);
		
		$of_options[] = array(
			'id' => 'author_tbb_link_text',
			'type' => 'text',
			'name' => __('Buy Now Button Text', 'author_ts') ,
			'std' => 'Click Here To Buy Now - $47 Only'
		);
		
		$of_options[] = array(
			'id' => 'author_tbb_link',
			'type' => 'text',
			'name' => __('Buy Now Button Link', 'author_ts') ,
			'std' => '#',
			'desc' => __('Keep it empty to remove the button on frontend.', 'author_ts')
		);
		
		$of_options[] = array(
			'id' => 'author_tbb_after_text',
			'type' => 'text',
			'name' => __('Buy Now Help Text', 'author_ts') ,
			'std' => 'Your book will be instantly available for download. Its in PDF format so you can enjoy it on all of your devices :)'
		);
		
		// Reviews Options
		
		$of_options[] = array(
			"name"   => __( "Reviews", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Reviews Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_reviews_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 32px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/reviews-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_reviews_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'Do you want to be trusted by your readers?'
		);
		$of_options[] = array(
			'id' => 'author_reviews_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Customer reviews will help with that, don’t miss to show them off.'
		);
		
		$of_options[] = array(
			'id' => 'author_reviews_readmore_text',
			'type' => 'text',
			'name' => __('View All Reviews Button Text', 'author_ts') ,
			'std' => 'View All Reviews'
		);
		
		$of_options[] = array(
			'id' => 'author_reviews_readmore_link',
			'type' => 'text',
			'name' => __('View All Reviews Button Link', 'author_ts') ,
			'std' => '',
			'desc' => __('Keep it empty to remove the button on frontend.', 'author_ts')
		);
		
		

		// Features Options

		$of_options[] = array(
			"name"   => __( "Features", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Features Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_feature_post_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 30px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/book-features-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_feature_post_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'What makes your book worth reading it?'
		);
		
		$of_options[] = array(
			'id' => 'author_feature_post_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Whats inside it? Why should anyone read it? You can show off the benefits here.'
		);
		
		$of_options[] = array(
			'id' => 'author_feature_readmore_text',
			'type' => 'text',
			'name' => __('View All Features Button Text', 'author_ts') ,
			'std' => 'View All Features'
		);
		
		$of_options[] = array(
			'id' => 'author_feature_readmore_link',
			'type' => 'text',
			'name' => __('View All Features Button Link', 'author_ts') ,
			'std' => '',
			'desc' => __('Keep it empty to remove the button on frontend.', 'author_ts')
		);
		
		

		// FAQs Options

		$of_options[] = array(
			"name"   => __( "FAQs", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"FAQs Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_faqs_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 32px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/faqs-icon.png'
		);
		$of_options[] = array(
			'id' => 'author_faqs_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'Answer all frequently asked questions (FAQs)'
		);
		
		$of_options[] = array(
			'id' => 'author_faqs_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Use this section to answer all frequently asked questions about your book.'
		);

		// About Author Options

		$of_options[] = array(
			"name"   => __( "About Author", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"About Author Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 30px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/about-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'Does anybody know about you?'
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Let people know who you are and what made you write this book. Ah, do show your face.'
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_name',
			'type' => 'text',
			'name' => __('Author Name', 'author_ts') ,
			'std' => 'John Taylor'
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_description',
			'type' => 'textarea',
			'name' => __('Author Bio', 'author_ts') ,
			'std' => '<p>This is the place to educate your readers about yourself. Why should they listen to you. What makes you an expert in the field of writing. Tell them why are you an authority in the niche and why should they learn from you.</p>
<p>Tell them about your personal life as well. Tell them about your book and writing experience. Why you decided to write this book and why you chose this topic. What goals do you want to achieve with this book and how are those goals important.</p>'
		);
		
		$of_options[] = array(
			'id' => 'author_about_me_image',
			'type' => 'media',
			'name' => __('Author Profile Image', 'author_ts') ,
			'desc' => __('Upload author profile image.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/author-image.jpg'
		);
		
		$of_options[] = array(
			'id' => 'author_facebook',
			'type' => 'text',
			'name' => __('Facebook Profile', 'author_ts') ,
			'std' => 'http://facebook.com'
		);
		
		$of_options[] = array(
			'id' => 'author_twitter',
			'type' => 'text',
			'name' => __('Twitter Profile', 'author_ts') ,
			'std' => 'http://twitter.com'
		);
		
		$of_options[] = array(
			'id' => 'author_googleplus',
			'type' => 'text',
			'name' => __('Google Profile', 'author_ts') ,
			'std' => 'https://plus.google.com'
		);
		
		$of_options[] = array(
			'id' => 'author_linkedin',
			'type' => 'text',
			'name' => __('LinkedIn Profile', 'author_ts') ,
			'std' => 'http://linkedin.com'
		);
		
		$of_options[] = array(
			'id' => 'author_email_address',
			'type' => 'text',
			'name' => __('Contact Email', 'author_ts') ,
			'std' => 'john@website.com'
		);
		
		// Blog Posts Options

		$of_options[] = array(
			"name"   => __( "Blog Posts", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Blog Posts Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
				
		$of_options[] = array(
			'id' => 'author_blog_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 32px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/blog-posts-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_blog_heading',
			'type' => 'text',
			'name' => __('Heading', 'author_ts') ,
			'std' => 'Do you want to communicate with your readers?'
		);
		
		$of_options[] = array(
			'id' => 'author_blog_sub_heading',
			'type' => 'text',
			'name' => __('Sub Heading', 'author_ts') ,
			'std' => 'Blogging is the best way you can do it. Go, write a blog post.'
		);
		
		$of_options[] = array(
			'id' => 'author_blog_readmore_text',
			'type' => 'text',
			'name' => __('View All Blog Posts Button Text', 'author_ts') ,
			'std' => 'View All Blog Posts'
		);
		
		$of_options[] = array(
			'id' => 'author_blog_readmore_link',
			'type' => 'text',
			'name' => __('View All Blog Posts Button Link', 'author_ts') ,
			'std' => '',
			'desc' => __('Keep it empty to remove the button on frontend.', 'author_ts')
		);
		
		// Footer Banner Options

		$of_options[] = array(
			"name"   => __( "Footer Banner", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Footer Banner Section\" on \"Home Page Template\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			"name"   => __( "Banner Layout", 'author-ts' ),
			"desc"  => __( "Choose banner layout, Author Theme offers two layouts one is called \"Optin Form Layout\" and other is called \"Buy Now Layout\".", 'author-ts' ),
			"id" => "author_footer_banner_layout",
			"std" => "f_b_l_1",
			"type" => "images",
			"options" => array(
				'f_b_l_1' => $url . 'footer-banner-optin.jpg',
				'f_b_l_2' => $url . 'footer-banner-buynow.jpg',
			)
		);
		
		$of_options[] = array( 
		
			"name"   => __( "Show Footer Banner On All Inner Pages", 'author-ts' ),
			"id" 		=> "author_fbb_showhide",
			"std" 		=> 0,
			"on" 		=> "Yes",
			"off" 		=> "No",
			"type" 		=> "switch"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Following options belong to both layouts.",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_footer_banner_icon',
			'type' => 'media',
			'name' => __('Icon', 'author_ts') ,
			'desc' => __('Preferred height and width is 32px and 30px respectively.', 'author_ts') ,
			'std' => '' . $defaultimagespath . '/images/footer-optin-icon.png'
		);
		
		$of_options[] = array(
			'id' => 'author_footer_banner_heading',
			'type' => 'text',
			'name' => 'Heading',
			'std' => 'Give your reader another chance to subscribe.'
		);
		
		$of_options[] = array(
			'id' => 'author_footer_banner_sub_heading',
			'type' => 'text',
			'name' => 'Sub Heading',
			'std' => 'Your reader made it this far. Appreciate it and give him another chance to stay connected.'
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Following options are for \"Optin Form Layout\" only.",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => "author_fbo_code",
			'type' => "textarea",
			'name' => "Optin Form Code",
			'desc' => "Code must be in HTML format. You can also use contact form shortcode here.",
			'std' => "<input type=\"text\" value=\"john@website.com\" class=\"wpcf7-text\" onfocus=\"if (this.value==this.defaultValue) this.value = ''\" onblur=\"if (this.value=='') this.value = this.defaultValue\"  />
<input type=\"submit\" value=\"Sign Up For a Free Chapter\" class=\"wpcf7-submit\" />"
		);
		
		$of_options[] = array(
			'id' => 'author_fbo_privacy',
			'type' => 'text',
			'name' => 'Privacy Statement',
			'std' => 'Promise, we do not spam our awesome readers :)'
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Following options are for \"Buy Now Layout\" only.",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			'id' => 'author_fbb_text',
			'type' => 'textarea',
			'name' => 'Buy Now Text',
			'std' => '<ul>
<li>Author Theme is completely SEO friendly.</li>
<li>Looks good on all available screen sizes.</li>
<li>Bundled with all common WP shortcodes.</li>
<li>Built in highly customizeable options panel.</li>
</ul>'
		);
		
		$of_options[] = array(
			'id' => 'author_fbb_link_text',
			'type' => 'text',
			'name' => __('Buy Now Button Text', 'author_ts'),
			'std' => 'Click Here To Buy Now - $47 Only'
		);
		
		$of_options[] = array(
			'id' => 'author_fbb_link',
			'type' => 'text',
			'name' => __('Buy Now Button Link', 'author_ts') ,
			'std' => '#',
			'desc' => __('Keep it empty to remove the button on frontend.', 'author_ts')
		);
		
		$of_options[] = array(
			'id' => 'author_fbb_privacy',
			'name' => 'Buy Now Help Text',
			'std' => 'Your book will be instantly available for download. Its in PDF format so you can enjoy on all devices :)',
			'type' => 'text',
		);

		// Footer Options

		$of_options[] = array(
			"name"   => __( "Footer", 'author-ts' ),
			"type" => "heading"
		);

		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "footer_info",
			"std" => "Options for \"Website Footer\".",
			"icon" => true,
			"type" => "info"
		);	

		$of_options[] = array(
			'id' => 'author_copyright_text',
			'type' => 'text',
			'name' => __('Copyright Text', 'author_ts') ,
			'std' => '© 2015 Author Theme'
		);
		
		$of_options[] = array(
			'id' => 'author_custom_scripts_footer',
			'type' => 'textarea',
			'name' => __('Custom Scripts', 'author_ts') ,
			'desc' => __('You can paste any custom scripts here that you want to load in footer.') ,
			'std' => ''
		);
		
		// Blog Setting Options

		$of_options[] = array(
			"name"   => __( "Single Post", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Single Blog Post Pages\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array( 
			"name"   => __( "Show Author Bio", 'author-ts' ),
			"id" 		=> "author_blogsetting_bio",
			"std" 		=> 1,
			"on" 		=> "Yes",
			"off" 		=> "No",
			"type" 		=> "switch",
			'desc'   => __( 'Do you want to display Author Bio on Single Post Pages.', 'author-ts' )
		);

			$of_options[] = array( 
		
			"name"   => __( "Show Social Sharing Icons", 'author-ts' ),
			"id" 		=> "author_blogsetting_sharing",
			"std" 		=> 1,
			"on" 		=> "Yes",
			"off" 		=> "No",
			"type" 		=> "switch",
			'desc'   => __( 'Do you want to display Social Sharing Icons on Single Post Pages.', 'author-ts' )
				);	
		
			$of_options[] = array( 
		
			"name"   => __( "Show Related Posts", 'author-ts' ),
			"id" 		=> "author_blogsetting_related_posts",
			"std" 		=> 1,
			"on" 		=> "Yes",
			"off" 		=> "No",
			"type" 		=> "switch",
			'desc'   => __( 'Do you want to display Related Posts on Single Post Pages.', 'author-ts' )
				);

		// Backup Options

		$of_options[] = array(
			"name"   => __( "Backup Options", 'author-ts' ),
			"type" => "heading"
		);
		
		$of_options[] = array(
			"name"   => __( "Info", 'author-ts' ),
			"id" => "introduction",
			"std" => "Options for \"Backup\", \"Restore\" and \"Transfer\" of \"Theme Options\".",
			"icon" => true,
			"type" => "info"
		);
		
		$of_options[] = array(
			"name"   => __( "Backup and Restore Options", 'author-ts' ),
			"id" => "of_backup",
			"std" => "",
			"type" => "backup",
			'desc'   => __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'author-ts' ),
		);
		$of_options[] = array(
			"name"   => __( "Transfer Theme Options Data", 'author-ts' ),
			"id" => "of_transfer",
			"std" => "",
			"type" => "transfer",
			'desc'   => __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'author-ts' ),
						
		);
				
		}
				
	}

?>