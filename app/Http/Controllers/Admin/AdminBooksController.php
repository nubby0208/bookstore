<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Requests\BooksCreateRequest;
use App\Http\Requests\BooksUpdateRequest;
use App\Image;
use App\PdfFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;
use Sburina\Whmcs\Facades\Whmcs;

class AdminBooksController extends AdminBaseController
{
    private $gid = 5;
    public function index()
    {
        $books = Book::with('category', 'author', 'image', 'pdf_file')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.books.index', compact('books'));
    }
    public function create()
    {
        return view('admin.books.create');
    }

    private $pack1booknames = [
        '10_Ricette_Halloween',
        'AAVV-12_Scheletri',
        'AAVV-300_parole_dorrore',
        'AAVV-Abbracciami',
        'AAVV-ABC_della_Patente_Europea_del_Computer',
        'AAVV-Adorami',
        'AAVV-Amore',
        'AAVV-A_Modo_Mio',
        'AAVV-Bi_Sogno',
        'AAVV-Case_Perse',
        'AAVV-Cerano_una_volta_le_favole',
        'AAVV-Cera_una_volta',
        'AAVV-Cicatrici',
        'AAVV-Conversazioni_con_Proust',
        'AAVV-Con_13_pugnalate_al_cuore',
        'AAVV-Costituzione_della_Repubblica_Italiana',
        'AAVV-Cronache_Zombi',
        'AAVV-Cuore_trafitto',
        'AAVV-Dark_Cosplay',
        'AAVV-Da_Illiers_a_Cabourg',
        'AAVV-Dietro_la_Nebbia',
        'AAVV-Ditelo_Con_I_Fiori',
        'AAVV-Doppio_Incubo',
        'AAVV-Fiabe_dal_Sud_America',
        'AAVV-Fiabe_popolari_russe',
        'AAVV-Fiabe_striscianti',
        'AAVV-Highlander',
        'AAVV-Il_Ripostiglio',
        'AAVV-I_sette_vizi_capitali',
        'AAVV-I_tre_volti_dellincubo',
        'AAVV-LAstronave_dimenticata',
        'AAVV-Lavare_con_cura',
        'AAVV-La_Canzone_dei_Nibelunghi',
        'AAVV-La_Canzone_di_Orlando',
        'AAVV-La_fame_del_diavolo',
        'AAVV-La_prima_volta_si_scorda_sempre',
        'AAVV-La_strada_per_lincubo',
        'AAVV-La_vendetta_dei_cattivi',
        'AAVV-LElfo_di_Saggina',
        'AAVV-LOscuro_Abbraccio_1',
        'AAVV-LOscuro_Abbraccio_2',
        'AAVV-Natale_in_noir',
        'AAVV-Natura_Morta',
        'AAVV-Nel_nome_del_figlio',
        'AAVV-Noir_Story',
        'AAVV-Notturno',
        'AAVV-Novelle_italiane_dalle_origini_al_Cinquecento',
        'AAVV-Oblio',
        'AAVV-Ombre',
        'AAVV-Orrore_Pirata',
        'AAVV-Orrori_in_Versi',
        'AAVV-Piccoli_Orrori',
        'AAVV-Porche_Malvagita',
        'AAVV-Portami_alla_vita',
        'AAVV-Pugili_Morti',
        'AAVV-Racconti_e_favole_di_Natale',
        'AAVV-Sangue_Marcio',
        'AAVV-Sangue_sui_Libri',
        'AAVV-Sanguinario_Valentino',
        'AAVV-Schegge_carnali',
        'AAVV-Schegge_di_Liberazione',
        'AAVV-Scheletri_nella_tela',
        'AAVV-Schizzi_di_Sangue',
        'AAVV-Scrivi_Pompei_2003',
        'AAVV-Selezione_naturale',
        'AAVV-Semlicemente_Zombi',
        'AAVV-Sfamami',
        'AAVV-Si_sta_come_a_Natale',
        'AAVV-Sogni_di_Morte',
        'AAVV-Stringimi',
        'AAVV-Una_monade_in_condominio',
        'AAVV-Una_penna_per_poe',
        'AAVV-Valentino_San',
        'AAVV-Veri_Mostri_1',
        'AAVV-Veri_Mostri_2',
        'AAVV-Verra_la_morte_e_avra_i_tuoi_occhi',
        'Alberto_Mirone-Gianchiade_Parte_prima_Nuova_genesi',
        'Alessandro_Basile-Angeli_prodotti_sotto_licenza_e_protetti_a_norma_di_legge',
        'Alessandro_Franci-Il_fermaglio',
        'Alessandro_Girola-Prometeo_e_la_guerra_1935',
        'Alessandro_Girola-Prometeo_e_la_guerra_1936',
        'Alessandro_Girola-RS33',
        'Alessandro_Girola-The_shift',
        'Alessandro_Girola-Uomini_e_lupi',
        'Alessandro_Manzoni-Adelchi',
        'Alessandro_Manzoni-Il_Cinque_Maggio_e_Il_Conte_di_Carmagnola',
        'Alessandro_Manzoni-I_Promessi_Sposi',
        'Alessandro_Manzoni-Storia_della_colonna_infame',
        'Alessandro_Stella-Programmare_per_il_web',
        'Alessandro_Tassoni-La_secchia_rapita',
        'Alessia_e_Michela_Orlando-Senza_macchie',
        'Alessio_Follieri-Ufo_Quale_verita',
        'Alessio_Romano-Erneste_e_Liale',
        'Alexandre_Dumas-Lavvelenatrice',
        'Alexia_Bianchini-Superciccio_e_Sisters',
        'Alex_Troma-Leviathan',
        'Alex_Troma-Short_Stories',
        'Alfonso_Dazzi-U_Boot_e_altre_storie',
        'Alfredo_Bruni-Vincenzo_il_pescivendolo',
        'Alfred_Jarry-Gesta_e_Opinioni_del_Dottor_Faustroll_patafisico',
    ];
    private $pack2booknames = [
        'Alfredo_Morganti-Dushara',
        'Alfredo_Morganti-Le_bolle_e_la_terra',
        'Alfredo_Morganti-Terzo_Tempo',
        'Alfredo_Panzini-Che_cosa_e_lamore',
        'Andrea_Comotti-Lorganigramma',
        'Andrea_Franco-La_buonanotte_del_demone',
        'Andrea_Grilli-Luccicanti_byte_verdi',
        'Andrea_Mucciolo-Ai_confini_delle_parole',
        'Andrea_Viscusi-Il_senso_della_vita',
        'Andrea_Viscusi-Mytholofiction',
        'Angelo_Benuzzi-La_settimana_dello_Scorpione',
        'Angelo_Cavallaro-Fatti_di_Sangue',
        'Angelo_Zabaglio-Ciclico_Anime_Ritrovate',
        'Anna_Radcliffe-I_misteri_del_castello_di_Udolfo_1di2',
        'Anna_Radcliffe-I_misteri_del_castello_di_Udolfo_2di2',
        'Antonio_Colombo-Jedna_la_piazza',
        'Antonio_Fogazzaro-Malombra',
        'Antonio_Fogazzaro-Piccolo_mondo_antico',
        'Antonio_Fogazzaro-Piccolo_mondo_moderno',
        'Antonio_lo_Gatto-I_miei_incubi',
        'Antonio_lo_Gatto-LIntreccio_di_universi_paralleli',
        'Apple-Storia',
        'Aristotele-Etica_Nicomachea',
        'Aristotele-La_Metafisica_Vol_1',
        'Arthur_Schopenhauer-Il_mondo_come_volonta_e_rappresentazione',
        'Blaise_Pascal-Pensieri',
        'Bonvesin_dela_Riva-Libro_delle_Tre_Scritture',
        'Brunetto_Latini-Il_Tesoretto',
        'B_R_Nanda-Biografia_di_Gandhi',
        'Camillo_Boito-Il_maestro_di_Setticlavio',
        'Camillo_Boito-Senso_Nuove_storielle_vane',
        'Carla_Mancosu-La_Cappella_Sistina_Vol_1',
        'Carla_Mancosu-La_Cappella_Sistina_Vol_2',
        'Carlo_Collodi-I_racconti_delle_fate',
        'Carlo_Collodi-Pinocchio',
        'Carlo_Goldoni-La_famiglia_dellantiquario',
        'Carlo_Goldoni-La_locandiera',
        'Carmelo_Faraci-Banchi_Matti',
        'Cecco_Angiolieri-Rime',
        'Cesare_Beccaria-Dei_delitti_e_delle_pene',
        'Charles_Dickens-David_Copperfield',
        'Charles_Dickens-Il_Cantico_di_Natale',
        'Charles_Dickens-Il_circolo_Pickwick',
        'Charles_Dickens-La_bottega_dellantiquario',
        'Charles_Dickens-La_piccola_Dorrit',
        'Charles_Dickens-Le_avventure_di_Nicholas_Nickleby',
        'Charles_Dickens-Le_due_citta',
        'Claudio_Zago-Fantascienza_e_Dintorni_2',
        'Cletto_Arrighi-Nana_a_Milano',
        'Collettivo_42-Open_Book',
        'Commissione_Europea-Scrivere_Chiaro',
        'Cornelio_Tacito-Annali',
        'Costanzo_Rapone-Isola',
        'Cristiano_Pugno-Genova_per_noi',
        'Cristina_Censi-Il_gioco_delloca',
        'Cristina_Censi-Morire_dal_ridere',
        'Cristina_Contilli-Alain_e_Juliette',
        'Cristina_Contilli-Dalla_prigionia_nello_Spielberg_al_ritorno_alla_vita',
        'Cristina_Contilli-Gli_intrighi_di_Albine',
        'Cristina_Contilli-Il_segreto_di_Alain',
        'Cristina_Contilli-In_Love_and_in_Exile',
        'Cristina_Contilli-I_due_ufficiali',
        'Cristina_Contilli-La_figlia_del_corsaro_francese',
        'Cristina_Contilli-La_vendetta_di_Etienne',
        'Cristina_Contilli-Parigi_era_solo_uno_sfondo',
        'Cristina_Contilli-The_Josephines_secret_daughter',
        'Cristina_Contilli-Vendetta_e_Perdono',
        'Cucina-Ricette_Cinesi',
        'Cucina-Ricette_Messicane',
        'CYB-Pillole_di_Veleno',
        'Cyrano_De_Bergerac-Il_Pedante_gabbato',
        'Daniele_Imperi-LAmbientazione_nel_fantastico',
        'Daniel_Defoe-Moll_Flanders',
        'Dante_Alighieri-Divina_Commedia',
        'Dante_Alighieri-Il_Convivio',
        'Dante_Alighieri-Il_fiore',
        'Dante_Alighieri-Rime',
        'Dario_Scognamiglio-Seth_il_Cercatore',
        'Davide_Brida-Appunti_di_Viaggio',
        'Davide_Vaccino-Tristitia',
        'Demetrio_Paolin-Una_tragedia_negata',
        'Dino_Campana-Canti_Orfici',
        'Dino_Campana-Inediti',
        'Edgar_Alan_Poe-Racconti_straordinari',
        'Edmondo_De_Amicis-Amore_e_ginnastica',
        'Edmondo_De_Amicis-Costantinopoli',
        'Edmondo_De_Amicis-Cuore',
        'Edmondo_De_Amicis-La_maestrina_degli_operai',
        'Elisa_Barindelli-La_Polvere',
        'Elvezio_Sciallis-Acerbe_seduzioni_di_morte',
        'Emanuele_Di_Marco-Lincompleto',
        'Emiliano_Maramonte-La_forma_del_delirio',
        'Emilio_Carnevali-In_difesa_di_Barack_Obama',
        'Emilio_Salgari-Alla_conquista_di_un_impero',
        'Emilio_Salgari-Capitan_Tempesta',
        'Emilio_Salgari-Gli_ultimi_filibustieri',
        'Emilio_Salgari-I_Corsari_delle_Bermuda',
        'Emilio_Salgari-I_misteri_della_jungla_nera',
        'Wu-Ming-Libera_Baku_Ora',
        'Wu_Ming_4-L_Eroe_imperfetto',
    ];
    private $pack3booknames = [
        'Emilio_Salgari-Il_Corsaro_Nero',
        'Emilio_Salgari-Il_figlio_del_Corsaro_Rosso',
        'Emilio_Salgari-Il_Re_del_mare',
        'Emilio_Salgari-Il_tesoro_della_montagna_azzurra',
        'Emilio_Salgari-I_pirati_della_Malesia',
        'Emilio_Salgari-Jolanda_la_figlia_del_Corsaro_Nero',
        'Emilio_Salgari-La_citta_del_Re_lebbroso',
        'Emilio_Salgari-La_favorita_del_Mahdi',
        'Emilio_Salgari-La_rivincita_di_Yanez',
        'Emilio_Salgari-Le_due_tigri',
        'Emilio_Salgari-Le_figlie_dei_faraoni',
        'Emilio_Salgari-Le_meraviglie_del_Duemila',
        'Emilio_Salgari-Le_novelle_marinaresche',
        'Emilio_Salgari-Le_tigri_di_Mompracem',
        'Emma_Perodi-Le_novelle_della_nonna',
        'Enzo_Milano-Anima_nera',
        'Enzo_Milano-Il_soldato_perfetto',
        'Enzo_Milano-Nome_in_codice_Lupo',
        'Erasmo_da_Rotterdam-Elogio_della_Follia',
        'Esopo-Favole',
        'Fabio_Calabrese-Dentro_e_fuori_di_noi',
        'Fabio_Calabrese-Il_risveglio_della_spada',
        'Fabio_Mentasti-LItalia_Di_Carzano',
        'Fabrizio_Uffreduzzi-Una_favola_del_medioevo_oscuro',
        'Fabrizio_Vercelli-Cacciatori_notturni_e_altre_storie',
        'Fausto_Di_Stefano-Leffimero_e_lillusorio_in_eta_barocca',
        'Federica_Ramponi-Il_cristallo_di_rocca',
        'Federico_De_Roberto-I_Vicere',
        'Federico_De_Roberto-La_messa_di_nozze',
        'Federigo_Tozzi-Bestie',
        'Federigo_Tozzi-Con_gli_occhi_chiusi',
        'Federigo_Tozzi-Lamore_novelle',
        'Federigo_Tozzi-Tre_croci',
        'Fedro-Tutte_le_favole',
        'Fortuna_Della_Porta-La_casa_di_Gaia',
        'Franca_Alaimo-Una_corona_di_latta',
        'Francesco_Carmine_Tedeschi-Le_nozze_doro',
        'Francesco_Coppola-Lorgoglio_del_santo',
        'Francesco_De_Sanctis-Storia_della_letteratura_italiana',
        'Francesco_Guicciardini-Storie_fiorentine',
        'Francesco_Marangi-Poesie',
        'Francesco_Ottana-Conijunctio_Astrorum',
        'Francesco_Petrarca-Il_Canzoniere',
        'Francesco_Petrarca-I_Trionfi',
        'Francesco_Petrarca-Rime',
        'Francois_Rabelais-Gargantua_e_Pantagruel',
        'Gabriele_DAnnunzio-Alcyone',
        'Gabriele_DAnnunzio-Giovanni_Episcopo',
        'Gabriele_DAnnunzio-Il_ferro',
        'Gabriele_DAnnunzio-Il_Piacere',
        'Gabriele_DAnnunzio-Laudi',
        'Gabriele_DAnnunzio-Linnocente',
        'Gabriele_DAnnunzio-Poema_paradisiaco',
        'Gabriele_DAnnunzio-Versi_damore',
        'Gaetano_Mosca-Che_cosa_e_la_Mafia',
        'Gaio_Sallustio_Crispo-La_congiura_di_Catilina',
        'Gaio_Valerio_Catullo-Carmina_Poesie',
        'Galileo_Galilei-Dialogo_sopra_i_due_massimi_sistemi',
        'Galileo_Galilei-Lettere',
        'Gennaro_Oliviero-Proust_e_le_Cattedrali',
        'Giacomo_Leopardi-I_Canti',
        'Giacomo_Leopardi-Lo_zibaldone',
        'Giacomo_Leopardi-Operette_morali',
        'Gianluca_Santini-Sardegna_Gialla',
        'Gianluigi_Lancelotti-Caduta_libera',
        'Gianpaolo_Borghini-Artificial_Paradise',
        'Gianpaolo_Borghini-Il_tango_dell_angelo_perduto',
        'Giorgio_Sangiorgi-Cristalli',
        'Giorgio_Sangiorgi-Dissolvenza',
        'Giorgio_Sangiorgi-Fiori_luminosi',
        'Giorgio_Sangiorgi-Il_Cercapersone',
        'Giorgio_Sangiorgi-Il_Sacro_Testo',
        'Giorgio_Sangiorgi-Pianeti',
        'Giosue_Carducci-Juvenilia',
        'Giosue_Carducci-Levia_Gravia',
        'Giosue_Carducci-Odi_Barbare',
        'Giosue_Carducci-Rime_e_Ritmi',
        'Giosue_Carducci-Rime_nuove',
        'Giovanni_Boccaccio-Amorosa_visione',
        'Giovanni_Boccaccio-Decameron',
        'Giovanni_Boccaccio-Elegia_di_Madonna_Fiammetta',
        'Giovanni_Boccaccio-Il_Corbaccio',
        'Giovanni_Boccaccio-Il_Filocolo',
        'Giovanni_Capotorto-Ricominciare',
        'Giovanni_Pascoli-Canti_di_Castelvecchio',
        'Giovanni_Pascoli-Il_fanciullino',
        'Giovanni_Pascoli-Myricae',
        'Giovanni_Pascoli-Primi_Poemetti',
        'Giovanni_Verga-Cavalleria_rusticana',
        'Giovanni_Verga-Il_marito_di_Elena',
        'Giovanni_Verga-I_Malavoglia',
        'Giovanni_Verga-Mastro_Don_Gesualdo',
        'Giovanni_Verga-Storia_di_una_capinera',
    ];
    private $pack4booknames = [
        'Giovanni_Verga-Tigre_reale_Eva',
        'Giovanni_Verga-Tutte_le_novelle',
        'Giovanni_Verga-Una_peccatrice',
        'Giuliano_Brenna-Luoghi_comuni',
        'Giuliano_Brenna-Ricette_in_brevi_storie',
        'Giulio_Mozzi-Corso_di_Scrittura_Condensato',
        'Giuseppe_Agnoletti-Dietro_la_Porta',
        'Giuseppe_Bisegna-6_strane_storie',
        'Giuseppe_Bisegna-Verita_deviate',
        'Giuseppe_Felice_Cassatella-Terra_e_Fuoco',
        'Giuseppe_Garibaldi-I_Mille',
        'Giuseppe_Parini-Le_Odi',
        'Giuseppe_Pastore-I_Giochi_della_Morte',
        'Giuseppe_Pitre-Fiabe_novelle_e_racconti_popolari_siciliani_Vol_1',
        'Giuseppe_Pitre-Fiabe_novelle_e_racconti_popolari_siciliani_Vol_2',
        'Giuseppe_Vergara-Rockshort',
        'Glauco_Silvestri-31_Ottobre',
        'Glauco_Silvestri-9753',
        'Glauco_Silvestri-Adamo',
        'Glauco_Silvestri-Address',
        'Glauco_Silvestri-Alla_deriva',
        'Glauco_Silvestri-Dualband',
        'Glauco_Silvestri-Elah',
        'Glauco_Silvestri-Elite',
        'Glauco_Silvestri-Eva',
        'Glauco_Silvestri-Gli_ultimi',
        'Glauco_Silvestri-Guerriero_delle_stelle',
        'Glauco_Silvestri-Hiroshi',
        'Glauco_Silvestri-Il_clan_delle_penne_la_genesi',
        'Glauco_Silvestri-Il_contributo',
        'Glauco_Silvestri-Il_desiderio_di_mordere',
        'Glauco_Silvestri-Inferno',
        'Glauco_Silvestri-Justice',
        'Glauco_Silvestri-La_guerra_di_Linda',
        'Glauco_Silvestri-La_taverna_di_dioniso',
        'Glauco_Silvestri-Lintervista',
        'Glauco_Silvestri-Luna_Oscura',
        'Glauco_Silvestri-Poker',
        'Glauco_Silvestri-Professione_Assassino',
        'Glauco_Silvestri-Sogno_di_capitano',
        'Glauco_Silvestri-Starship_Journal',
        'Glauco_Silvestri-UFO',
        'Grazia_Deledda-Canne_al_Vento',
        'Grazia_Deledda-Cenere',
        'Grazia_Deledda-Chiaroscuro',
        'Grazia_Deledda-Cosima',
        'Grazia_Deledda-Fior_di_Sardegna',
        'Grazia_Deledda-Il_paese_del_vento',
        'Grazia_Deledda-Il_vecchio_della_montagna',
        'Grazia_Deledda-La_casa_del_poeta',
        'Grazia_Deledda-La_madre',
        'Grazia_Deledda-La_via_del_Male',
        'Grazia_Deledda-Lincendio_nelloliveto',
        'Grazia_Deledda-Marianna_Sirca',
        'Grazia_Deledda-Novelle_Vol_1',
        'Grazia_Deledda-Racconti_Sardi',
        'Guglielmo_Laguardia-Woodstock',
        'Guglielmo_Peralta-La_fiaba_la_parola_la_luce',
        'Guido_Cavalcanti-Rime',
        'Guido_Del_Duca-A_che_punto_e_la_notte',
        'Hans_Christian_Andersen-40_Novelle',
        'Hans_Christian_Andersen-Fiabe',
        'Harriet_Beecher_Stowe-La_capanna_dello_zio_Tom',
        'Henrik_Ibsen-Poesie_complete',
        'Henryk_Sienkiewicz-Il_diluvio',
        'Henryk_Sienkiewicz-Quo_vadis',
        'Henry_David_Thoreau-Walking',
        'Honore_De_Balzac-Eugenie_Grandet',
        'Iacopone_Da_Todi-Laude',
        'Ippolito_Nievo-Confessioni_di_un_Italiano',
        'Italo_Svevo-La_coscienza_di_Zeno',
        'Italo_Svevo-La_novella_del_buon_vecchio_e_della_bella_fanciulla',
        'Italo_Svevo-Senilita',
        'Italo_Svevo-Tutti_i_racconti',
        'Italo_Svevo-Una_vita',
        'Ivano_DellArmi-Il_fiore_delle_tenebre',
        'Ivano_DellArmi-LAntro_dei_perduti',
        'Ivano_DellArmi-SHAYA_e_il_segreto_della_valle_perduta',
        'Ivano_DellArmi-Ska_Kyatouk',
        'Ivan_Sergeevic_Turgenev-Terre_vergini',
        'Jachob_Grimm-Fiabe',
        'James_Matthew_Barrie-Peter_Pan',
        'Jerome_K_Jerome -Tre_uomini_in_barca',
        'Johann_Wolfgang_Goethe-I_dolori_del_giovane_Werther',
        'John_Milton-Il_Paradiso_Perduto',
        'Jose_Asuncion_Silva-Il_libro_dei_versi',
        'Jose_Asuncion_Silva-Poesie_in_italiano',
        'Jules_Verne-La_strabiliante_avventura_della_missione_Barsac',
        'Laura_Cherri-Mysterium_I',
        'Laura_Cherri-Mysterium_II',
        'Laura_Cherri-Mysterium_III',
        'Laura_Schirru-Cronache_del_mondo_strambo',
        'La_Scuola_Siciliana-Antologia_poetica',
        'Leila_Baiardo-Barzellette',
        'Leila_Baiardo-Incontri',
        'Leonardo_Colombi-Anima_Perduta',
        'Leonardo_Colombi-Racconti_di_Leonardo_Colombi',
        'Leonardo_Zarrelli-La_sera_esco',
        'Lev_N_Tolstoj-Denaro_Falso',
        'Lewis_Carroll-Alice_nel_paese_delle_meraviglie',
    ];
    private $pack5booknames = [
        'Lewis_Carroll-Attraverso_lo_specchio',
        'Lorenzo_Muccioli-Le_Novelle_di_Ciccone',
        'Loris_Bagnara-Mutazioni',
        'Louisa_May_Alcott-Piccole_donne',
        'Luca_Coletta-Come_si_Scrive',
        'Luca_Di_Gialleonardo-Docili_Tenebre',
        'Luciano_Zuccoli-Lamore_di_Loredana',
        'Ludovico_Ariosto-Il_Negromante',
        'Ludovico_Ariosto-La_Lena',
        'Ludovico_Ariosto-Orlando_Furioso_Vol_1',
        'Ludovico_Ariosto-Orlando_Furioso_Vol_2',
        'Ludovico_Ariosto-Satire',
        'Luigi_Brasili-Delitti_Rimorsi_e_Vendette',
        'Luigi_Capuana-Chi_vuol_fiabe_Chi_vuole',
        'Luigi_Capuana-Delitto_ideale',
        'Luigi_Capuana-Giacinta',
        'Luigi_Capuana-Gli_Americani_di_Rabbato',
        'Luigi_Capuana-Profumo',
        'Luigi_Capuana-Tutte_le_fiabe',
        'Luigi_Pirandello-Cosi_e_se_vi_pare',
        'Luigi_Pirandello-Il_fu_Mattia_Pascal',
        'Luigi_Pirandello-I_vecchi_e_i_giovani',
        'Luigi_Pirandello-Lesclusa',
        'Luigi_Pirandello-Novelle_per_un_anno',
        'Luigi_Pirandello-Quaderni_di_Serafino_Gubbio_operatore',
        'Luigi_Pirandello-Sei_personaggi_in_cerca_dautore',
        'Luigi_Pirandello-Uno_nessuno_e_centomila',
        'Magda_Vigilante-Il_maestro_del_caduceo',
        'Marcello_Marinisi-Lalba_del_crepuscolo',
        'Marcello_Moribonti_II-Storie_da_Antomox',
        'Marco_Barbareschi-Gocce_di_saggezza',
        'Marco_Cazzella-Angelian',
        'Marco_Cicoli-4_storie_tossiche',
        'Marco_Lorenzetti-Racconti_Visionari',
        'Marco_Negri-in_eBook',
        'Marco_Polo-Il_Milione',
        'Margit_Kafkka-Destino_di_donna',
        'Maria_Musik-Dodici_rintocchi',
        'Marilia_Tortora-Diversi_sotto_lo_stesso_cielo',
        'Marx_ed_Engels-Manifesto_del_Partito_Comunista',
        'Marzia_Dati-Traduzione_intersemiotica_Il_Demone',
        'Massimiliano_Prandini-Bestiario_Stravagante',
        'Massimo_Guetti-Sulle_orme_dellincubo',
        'Massimo_Mangani-The_Patrolman',
        'Massimo_Tommolillo-Fuori_di_se',
        'Massimo_Tommolillo-Rusalka_Lo_spirito_dellacqua',
        'Matilde_Serao-Il_paese_di_Cuccagna',
        'Matilde_Serao-Il_ventre_di_Napoli',
        'Matilde_Serao-Storia_di_due_anime',
        'Matteo_Bandello-Tutte_le_novelle',
        'Matteo_Grimaldi-Veleno_Rosso_Sangue',
        'Matteo_Maria_Boiardo-Orlando_Innamorato',
        'Matteo_Poropat-Lagomorpha',
        'Maurilio_Gnometto-Il_Codice_di_Vince',
        'Mauro_Arpino-Le_idee_dellAstronomia',
        'Memius-Springletown_1980',
        'Michael_Beatrice-Il_decalogo',
        'Michela_Duce_Castellazzo-Chi_e_uguale_a_Dio',
        'Michela_Duce_Castellazzo-Tre_racconti',
        'Michele_Arcadipane-Creare_un_ebook_con_OpenOffice_Writer',
        'Michel_Franzoso-Robot',
        'Miguel_De_Cervantes-Don_Chisciotte_Vol_1',
        'Miguel_De_Cervantes-Don_Chisciotte_Vol_2',
        'Monica_Tessarin-LOra_della_Vendetta',
        'Monica_Viola-Tana_per_la_bambina_con_i_capelli_a_ombrellone',
        'Nathaniel_Hawthorne-La_lettera_scarlatta',
        'Niccolo_Machiavelli-Favola_di_Belfagor_arcidiavolo',
        'Niccolo_Machiavelli-Il_Principe',
        'Niccolo_Machiavelli-Lettere_a_Francesco_Vettori',
        'Omero-Iliade',
        'Omero-Odissea',
        'Oscar_Wilde-Il_delitto_di_Lord_Arthur_Savile',
        'Pamela_Boiocchi-Dolci_Evasioni',
        'Pamela_Boiocchi-Il_Tempo_della_Memoria',
        'Paolo_Accorsi-I_Racconti_del_Becchino',
        'Paolo_Attivissimo-Luna_S_ci_siamo_andati',
        'Paolo_Mantegazza-Lanno_3000',
        'Paolo_Mantegazza-Un_giorno_a_Madera',
        'Pasquale_Francia-Attraverso_sentieri_perduti',
        'Pasquale_Francia-La_Maledizione_del_Teschio',
        'Pasquale_Francia-Tre_casi_di_Robert_Price',
        'Pee_Gee_Daniel-Vittoria_Finale',
        'Pellegrino_Artusi-La_scienza_in_cucina_e_larte_di_mangiar_bene',
        'Peter_Patti-Transits',
        'Pierluigi_Selvatici-Coriandoli',
        'Piero_Cioni-Ssun_Fleet_Senza_rancore',
        'Pierre_Jean_Brouillaud-Le_serate_du_Blue_Buzzard',
        'Pietro_Aliprandi-Le_Porte_dellAbisso',
        'Pietro_Aretino-La_Cortigiana',
        'Pietro_Bembo-Gli_Asolani',
        'Pietro_Bembo-Prose_della_volgar_lingua',
        'Pietro_Moretti-Mistificazioni',
        'Platone-Apologia_di_Socrate',
        'Platone-Fedro',
        'Platone-Il_Critone',
        'Platone-Il_Parmenide',
        'Platone-Simposio',
        'Providence_Ayanami-A_Broken_Soldier',
        'Publio_Virgilio_Marone-Eneide',
        'Raffaele_Gambigliani_Zoccoli-Una_scommessa_incrociata',
    ];
    private $pack6booknames = [
        'AAVV-1000_e_non_piu_1000',
        'AAVV-E_far_l_amore_anche_se_il_mondo_muore',
        'AAVV-Halloween_Nights',
        'AAVV-Le_mille_e_una_notte',
        'AAVV-Le_vie_di_Marcel_Proust',
        'AAVV-L_ennesimo_libro_della_fantascienza',
        'AAVV-Non_si_odono_i_suoi_passi',
        'AAVV-Schegge_di_Liberazione_bonus_tracks',
        'AAVV-Scheletri_nellArmadio',
        'AAVV-Sud_Altrove',
        'Annalisa_D_Alessandro-L_avventura_spaziale_della_prima_donna_comandante',
        'Antar_Mohamed-Timira',
        'Antonio_De_Marchi-LAltro_LEvanescenza_dellAngelo',
        'Boorp_com-100_Aforismi',
        'Boorp_com-100_Barzellette',
        'Carlo_Dulinizo-Pensieri_in_apnea',
        'Coltivareorto_it-Come_coltivare_l_orto_in_balcone',
        'Cristiana_Tumedei-Creare_una_campagna_di_Web_Marketing',
        'Cristiana_Tumedei-Creare_un_blog',
        'Cristiano_Pugno-Canto_dei_Verdi_Marci',
        'Daniele_Imperi-Anima_Selvatica',
        'Daniele_Imperi-Diario_Ultimo',
        'Daniele_Imperi-Figli_dell_inverno',
        'Daniele_Imperi-il_campo_dei_dannati',
        'Daniele_Imperi-Il_Sanatorio_delle_Coincidenze_Esagerate',
        'Daniele_Imperi-La_Documentazione_in_narrativa',
        'Daniele_Imperi-Lo_sconosciuto-degli_abissi',
        'Daniele_Imperi-L_isola_delle_ombre_bianche',
        'Daniele_Imperi-Scrittura_per_il_web',
        'Daniele_Imperi-Zombie_Safari',
        'Davide_Bertinotti-Come_fare_la_Birra_in_casa',
        'Davide_Mana-Pianeta_Rosso',
        'Domenico_Cirasole-Il precario_Ugo_sfida_la_privilegiata_casta',
        'Elena_Marinelli-Febbraio_29',
        'Enrico_Novelli-L_allevatore di dinosauri',
        'Floriana_Lauriola-Da_domani_cambio',
        'Franca_Alaimo-Sorsi',
        'Francesco_Coppola-Sottovento',
        'Francis_Scott_Fitzgerald-Il_Grande_Gatsby',
        'Franco_Tripoli-25_Poesie',
        'George_Gordon_Byron-Ore_d_Ozio_Bardi_Inglesi',
        'Giacomo_Barnes-Giustizia_Sociale',
        'Guglielmo_Laguardia-Diario',
        'Guglielmo_Laguardia-Discorsi_di_Gandhi',
        'Guglielmo_Laguardia-Diversita',
        'Guglielmo_Laguardia-I_personaggi_della_pace',
        'Gustaf_Mittag_Leffler-Niels_Henrik_Abel',
        'Juliette_Yakashy-Una_Famiglia_Speciale',
        'Luigi_Bonaro-Fenomenologia_robotica',
        'Marcello_Angelone-Apologia_dei_Miscredenti',
        'Marco_Agustoni-Come_un_dinosauro_in_un_bicchier_d_acqua',
        'Massimo_Baglione-Blue_Bull',
        'Mencaroni_Scarparo-Storie_delle_Colonie',
        'Raffaele_Serafini-Bare_per_Barattoli',
        'Raffaele_Serafini-Quadri_per_prigioni',
        'Raffaele_Serafini-Usciti_dalla_Fossa',
        'Ramac-JavaScript',
        'Riccardo_Ferrazzi-I_nomi_sacri',
        'Riccardo_Jevola-Romanzo_Italiano',
        'Roberto_Maggiani-Cartoline_intergalattiche',
        'Roberto_Mosi-Florentia',
        'Roberto_Mosi-Itinera',
        'Roberto_Perrino-Energia_nucleare_come_funziona',
        'Roberto_Perrino-I_giochi_innocenti',
        'Roberto_Santachiara-Point_Lenana',
        'Rossella_Cerniglia-Adolescenza_infinita',
        'Rossella_Tempesta-Inequilibrio',
        'Rudyard_Kipling-Il_libro_delle_bestie',
        'Ryokan_Daigu-Poesie',
        'Salvatore_Di_Giacomo-Assunta_Spina',
        'Salvatore_Solinas-Il_fior_fiore_del_male',
        'Samanta_Catastini-Speranza_dAmore',
        'Samuel_Marolla-Una_notte_al_Ghibli',
        'Sergio_Bissoli-Donne_dallAbisso',
        'Sergio_Cesaratto-Oltre_lausterita',
        'Sergio_DAmaro-Lalba_di_Solange',
        'Silvio_Pellico-Le_mie_prigioni',
        'Simona_Cremonini-Il_Visitatore_Notturno',
        'Simonetta_Santamaria-Black_Millennium',
        'Simone_Ceccano-Leggende_della_cripta_di_chtulhu',
        'Simone_Conti-Fameliche_Novelle',
        'Simone_Maria_Navarra-Il_gatto_che_cadde_dal_Sole',
        'Simone_Maria_Navarra-Mozart_di_Atlantide',
        'Simone_Piazzesi-Il_mare_nel_cielo',
        'Smaniotto_Maxence-irRealta',
        'Sofocle-Tutte_le_tragedie',
        'Sonia_Magliari-Necrode5',
        'Stefano_Fumagalli-Sritto_nella_sabbia',
        'Stendhal-Il_rosso_e_il_nero',
        'Stendhal-La_Certosa_di_Parma',
        'Stephen_Davis-Le_Farfalle_sono_Libere_di_Volare',
        'Strumm-Diario_Pulp',
        'Strumm-IX_Non_desiderare_la_pecora_daltri',
        'Supercomputer-Storia',
        'Tiziana_Colusso-La_criminale_sono_io',
        'Tiziano_Umbert_Wolky-Gli_Assurdi_della_Torre_del_Filosofo',
        'Tommaso_Boni-Io_Adriano_nessuno',
        'Tommaso_Boni-Tuco_delle_Isole',
        'Tommaso_Campanella-La_citta_del_sole',
        'Tommaso_Campanella-Tutte_le_poesie',
        
    ];
    private $pack7booknames = [
        'AAVV-Il_tempo_vissuto',
        'AAVV-La_pace_e_in_fiamme',
        'AAVV-Premio_Babuk_2015',
        'AAVV-Premio_Babuk_2016',
        'AAVV-Premio_Babuk_2017',
        'AAVV-Quattro_Parti_Normalita_Estrema',
        'AAVV-Secoli_bui',
        'AAVV-Un_lieve_ronzio',
        'Alberto_Rizzi-Poesie_dell_uccidere_in_volo',
        'Alessandro_Franci-Sbagliando_strada',
        'Andrea_Leone-Scena_della_violenza',
        'Angra_Planetzero-Marstenheim',
        'Annamaria_Ferramosca-Curve_di_livello',
        'Annamaria_Ferramosca-Il_versante_vero',
        'Anna_de_Noailles-Le_Passioni_traduzione_Giuliano_Brenna',
        'Antonio_Mazziotta-Due_insieme',
        'Armando_Tagliavento-Una_vita_a_pezzi',
        'Beppe_Grillo-Schiavi_moderni',
        'Claudia_Zironi-Jump',
        'Cristina_Sparagana-I_cento_martiri_di_Salamina',
        'Davide_Cortese-ANUDA',
        'Davide_Gariti-Due_minuti_all_ombra',
        'Davide_Morelli-Dalla_finestra',
        'Davide_Morelli-Varie_ed_eventuali',
        'Domenico_Cara-Ellittiche_gravita',
        'Emilio_Capaccio-Malinconico_oscuro',
        'Ester_Monachino-Logos_spermatikos',
        'Fabia Ghenzovich-Il_cielo_aperto_del_corpo',
        'Fabio_Pasquarella-Il_sasso_e_la_rana',
        'Floriana_Porta-Intrecci_d_acqua_terra_e_cielo',
        'Francesca_Simonetti-Poesie_per_una_conversazione',
        'Franco_Buffoni-Nuove_poesie',
        'Franco_Tripoli-30_Poesie',
        'Gabriella_Maleti-Vecchi_corpi',
        'Gennaro_Oliviero-Apparizioni_pittoriche_nella_Recherche',
        'Gennaro_Oliviero-Francois_Villon_poeta_e_martire',
        'Gianpaolo_Borghini-Lavoro_delusioni_e_alieni',
        'Gian_Maria_Turi-Canti_della_burocrazia',
        'Gian_Maria_Turi-Darshana_de_Malchut',
        'Gian_Piero_Stefanoni-Da_questo_mare',
        'Gian_Piero_Stefanoni-La_terra_che_snida_ai_perdoni',
        'Gian_Piero_Stefanoni-La_tua_destra',
        'Gioele_Urso-Suicidio_Culinario',
        'Giordano_Bruno-Biografia',
        'Giovanna_Iorio-Due_raccolte_smarrite',
        'Giovanna_Iorio-Sul_mare',
        'Giovanni_Baldaccini-Il_posto_delle_piaghe_lucenti',
        'Giovanni_Baldaccini-Tre_notti',
        'Giuseppe_Pellegrino-Saxolalie_1-17',
        'Gualberto_Alvino-Web_effects',
        'Leonardo_Colombi-What_is_dissacrando',
        'Letizia_Dimartino-Una_domenica_mattina',
        'Luca_Ariano-Bitume_d_intorno',
        'Lucius_Etruscus-Lupin_Contro_Holmes',
        'Marco_Furia-Scritti_echi',
        'Maria_Musik-Copertina',
        'Mariolina_La_Monica-Vagheggiando_Itaca',
        'Mario_Fresa-Le_parole_viventi',
        'Massimo_de_Bonfils-Dopo_il_Conservatorio',
        'Massimo_de_Bonfils-Materiali_e_suono_nel_violino',
        'Massimo_de_Bonfils-Vademecum_del_Violinista',
        'Meth_Sambiase-Il_segno_semplice',
        'Michela_Duce_Castellazzo-Aqua_Mater',
        'Nicla_Pandolfo-Caffe_Rosa',
        'Nicla_Pandolfo-La_porta_chiusa',
        'Nino_Asuni-Frammenti_della_memoria',
        'Paolo_Polvani-Il_crollo_di_via_Canosa',
        'Riccardo_Merendi-Diamond',
        'Riccardo_Merendi-Evoluzione',
        'Riccardo_Merendi-La_Pietra_dei_Maya',
        'Roberto_Maggiani-L_indicibile',
        'Roberto_Maggiani-Spazio_espanso',
        'Rosaria_Di_Donato-Lustrante_d_acqua',
        'Rosa_Riggio-Orizzonte_alle_spalle',
        'Rosemily_Paticchio-Entropie',
        'Sara_Zaghini-Lev_Semenovic_Rubinstejn',
        'Silvia_Rosa-Incontri_poetici',
        'Simone_Consorti-Gli_amanti_bendati',
        'Stefano_Centrone-Benvenuto_allinferno',
        'Torquato_Tasso-Aminta',
        'Torquato_Tasso-Gerusalemme_liberata',
        'Tsao_Cevoli-Io_non_dimentico',
        'Ugo_Foscolo-Dei_Sepolcri',
        'Ugo_Foscolo-Le_Grazie',
        'Ugo_Foscolo-Sonetti',
        'Ugo_Foscolo-Ultime_Lettere_di_Jacopo_Ortis',
        'Uriel_Fanelli-Altri_Robot',
        'Uriel_Fanelli-Cibo',
        'Valerio_Bonante-La_sindrome_da_defecazione_mostruosa',
        'Valter_Giraudo-Pillole_di_terrore',
        'Vincenzo_Borriello-Helvete',
        'Vitaliano_Ravagli-Asce_di_guerra',
        'Vittorio_Alfieri-Filippo',
        'Vittorio_Alfieri-Vita_scritta_da_esso',
        'Vittorio_Goffredo-Racconti',
        'Voltaire-Candido_ovvero_lottimismo',
        'Wu_Ming-54',
        'Wu_Ming-Altai',
        'Wu_Ming-Giap',
        'Wu_Ming_2-Guerra_agli_umani',
        
    ];
    private $pack8booknames = [
        'Alexandre_Dumas-Il_Conte_di_Montecristo',
        'Alexandre_Dumas-La_signora_delle_camelie',
        'Arthur_Conan_Doyle-Uno_studio_in_rosso',
        'Bram_Stoker-Dracula',
        'Charles_Dickens-La_casa_dei_fantasmi',
        'Daniele_Imperi-Fuga_dal_tempo',
        'Daniele_Imperi-La_pietra_venuta_dal_cielo',
        'Daniele_Imperi-La_Storia_di_Dracula',
        'Franz_Kafka-La_metamorfosi_e_altri_racconti',
        'Giuseppe_Pitre-La_vita_in_Palermo_cento_e_pi—_anni_fa_Vol_1',
        'Giuseppe_Pitre-La_vita_in_Palermo_cento_e_pi—_anni_fa_Vol_2',
        'Joseph_Conrad-Cuore_di_Tenebra',
        'Jules_Verne-Ventimila_leghe_sotto_i_mari',
        'Oscar_Wilde-Il_fantasma_di_Canterville',
        'Robert_Luis_Stevenson-Dottor_Jekyll_e_Mr_Hyde',
        'Stefano_Centrone-Maria',
        'Terminetor_Magnetico-Battle_for_Assuan',
        'Terminetor_Magnetico-Il_Dottor_Quatermenga',
        'Terminetor_Magnetico-Intervista_dalle_Colonie_Extramondo',
        'Terminetor_Magnetico-La_stella_verde',
        'Terminetor_Magnetico-Orizzonti_Sintetici',
        'Terminetor_Magnetico-Per_la_Gloria_di_Chartago',
        'Terminetor_Magnetico-Project_Ufo',
        'Terminetor_Magnetico-Raumpatrouille_Orion',
        'Terminetor_Magnetico-Rim_of_Hell',
        'Terminetor_Magnetico-Warning_Area_51',
        'Tomaso_Pieragnolo-Ad_ora_incerta_traduzioni',
        'Tomaso_Pieragnolo-Nell_imminenza_del_giorno',
        'Valentina_Corbani-Saggi_sparsi_su_Proust',
        'Valeria_Serofilli-Chiedo_i_cerchi',
        'Valeria_Serofilli-Ulisse',
        'Wallace_Lee-Baker_Team',
        'Wallace_Lee-Point_of_No_Return',
        'Wallace_Lee-Rambo_Year_One',
        'Wu_Ming-Anatra_all_arancia_meccanica',
        'Wu_Ming-Armata_dei_Sonnambuli',
        'Wu_Ming-L_invisibile_ovunque',
        'Wu_Ming_1-Un_viaggio_che_non_promettiamo_breve',
        
    ];

    public function store(BooksCreateRequest $request)
    {
        $input = $request->all();
        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        $booknames = $this->pack2booknames;

        foreach($booknames as $bookname){
            $input['title'] = $bookname;
            $input['slug'] = $bookname;
            $input['description'] = 'This book is '.$bookname;

            //whmcs add product
            $result = \Whmcs::AddProduct([
                // 'name' => $request->name,
                // 'gid' => 4,
                'type' => 'other',
                'gid' => $this->gid,
                'paytype' => 'onetime',
                'pricing' => array(1 => array('monthly' => $input['price'], 'msetupfee' => 1.99, 'quarterly' => 2.00, 'qsetupfee' => 1.99, 'semiannually' => 3.00, 'ssetupfee' => 1.99, 'annually' => 4.00, 'asetupfee' => 1.99, 'biennially' => 5.00, 'bsetupfee' => 1.99, 'triennially' => 6.00, 'tsetupfee' => 1.99)),
                'name' => $bookname,
            ]);

            //if failed redirect
            if($result["result"] != "success")
                return redirect('/admin/books')
                ->with('success_message', ' Book creation failed');

            //if success get product id
            $result = \Whmcs::GetProducts([
            ]);
            foreach (array_reverse($result['products']['product']) as $Item)
            {
                if($Item['name'] == $bookname)
                    $input['id'] = $Item['pid'];
            }

            if($file = $request->file('image_id'))
            {
                $image = Image::create(['file'=>$bookname.'.png']);
                $input['image_id'] = $image->id;
            }
            if($pdf_file = $request->file('pdf_id'))
            {
                $pdf_name = 'assets/pdf/'.$bookname.'.pdf';
                $pdf = PdfFile::create(['pdf_file'=>$pdf_name]);
                $input['pdf_id'] = $pdf->id;
            }
            $create_books = Book::create($input);
        }
        
        return redirect('/admin/books')
            ->with('success_message', 'Book created successfully');

    }

    public function store1(BooksCreateRequest $request)
    {
        $input = $request->all();
        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        //whmcs add product
        $result = \Whmcs::AddProduct([
            // 'name' => $request->name,
            // 'gid' => 4,
            'type' => 'other',
            'gid' => $this->gid,
            'paytype' => 'onetime',
            'pricing' => array(1 => array('monthly' => $input['price'], 'msetupfee' => 1.99, 'quarterly' => 2.00, 'qsetupfee' => 1.99, 'semiannually' => 3.00, 'ssetupfee' => 1.99, 'annually' => 4.00, 'asetupfee' => 1.99, 'biennially' => 5.00, 'bsetupfee' => 1.99, 'triennially' => 6.00, 'tsetupfee' => 1.99)),
            'name' => $request->title,
        ]);
        
        //if failed redirect
        if($result["result"] != "success")
            return redirect('/admin/books')
            ->with('success_message', $request->name . ' Book creation failed');
        
        //if success get product id
        $result = \Whmcs::GetProducts([
        ]);
        foreach (array_reverse($result['products']['product']) as $Item)
        {
            if($Item['name'] == $request->title)
                $input['id'] = $Item['pid'];
        }

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }
        if($pdf_file = $request->file('pdf_id'))
        {
            $pdf_name = $pdf_file->getClientOriginalName();
            $pdf_name = 'assets/pdf/'.$pdf_name;
            $pdf = PdfFile::create(['pdf_file'=>$pdf_name]);
            $input['pdf_id'] = $pdf->id;

            $sourceFilePath=$pdf_file->getRealPath();
            $destinationPath=public_path()."/$pdf_name";
            $success = \File::copy($sourceFilePath,$destinationPath);   
        }

        $create_books = Book::create($input);
        return redirect('/admin/books')
            ->with('success_message', 'Book created successfully');

    }
    
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));

    }
    public function update(BooksUpdateRequest $request, $id)
    {
        $input = $request->all();

        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        if($pdf_file = $request->file('pdf_id'))
        {
            $pdf_name = $pdf_file->getClientOriginalName();
            $pdf_name = 'assets/pdf/'.$pdf_name;
            $pdf = PdfFile::create(['pdf_file'=>$pdf_name]);
            $input['pdf_id'] = $pdf->id;

            $sourceFilePath=$pdf_file->getRealPath();
            $destinationPath=public_path()."/$pdf_name";
            $success = \File::copy($sourceFilePath,$destinationPath); 
        }

        $book = Book::findOrFail($id);
        $book->update($input);
        return redirect('/admin/books')
            ->with('success_message', 'Book updated successfully');

    }

    public function destroy($id)
    {
        $book= Book::findOrFail($id);
        $book->delete();
        return redirect()->back()->with('alert_message', 'Book move to trash');
    }

    public function restore($id)
    {
        $trash = Book::onlyTrashed()->findOrFail($id);
        $trash->restore();
        return redirect()->back()
            ->with('success_message', 'Book successfully restore from trash');
    }

    public function forceDelete($id)
    {
        $trash_book = Book::onlyTrashed()->findOrfail($id);
        if(!is_null($trash_book->image_id))
        {
            unlink(public_path().'/assets/img/'.$trash_book->image->file);
        }
        $trash_book->image->delete();
        $trash_book->forceDelete();
        return redirect()->back()
            ->with('alert_message', 'Book deleted permanently');
    }

    public function trashBooks()
    {
        $books = Book::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.books.trash-books', compact('books'));
    }

    public function discountBooks()
    {
        $discount_books = "All books with discount";
        $books = Book::with('author', 'category')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)->get();

        return view('admin.books.index', compact('books', 'discount_books'));
    }


}
