
#set page(
  numbering: "1",
  number-align: center,
  paper: "a4",
  margin: (x: 2cm, y: 2.5cm),
)
#set heading(
  numbering: "1.1",
)

#align(center,image("./imgs/logo.PNG", width: 15em, height: 15em))
#v(-4em)
#align(center, text("GagGym", size: 3em, weight: "bold"))
#v(-2em)
#align(center, text("Progetto corso di Tecnologie Web A.A. 2023/2024", style: "italic"))
#v(1em)
#align(center, [*Realizzato da:*])
#align(center, 
 [] 
)

#table(
    columns: (1fr,2fr,2fr), 
    align: center+horizon,
    [*Matricola*],[*Nome e Cognome*],[*Email*],
    [2042346], [Riccardo Carraro (*referente*)], [riccardo.carraro.10\@studenti.unipd.it],
    [2046424], [Endi  Hysa], [endi.hysa\@studenti.unipd.it],
    [2044223], [Andrea Giurisato], [andrea.giurisato\@studenti.unipd.it],
    [2042325], [Michele Ogniben], [michele.ogniben\@studenti.unipd.it],
  )

#v(2em)
#align(center, [*Indirizzo del sito* \ #link("http://tecweb.studenti.math.unipd.it/rcarraro")])
#v(1em)
#align(center, [*Repository del progetto* \ #link("https://github.com/Carraro-Riccardo/Progetto-Tecnologie-Web")])
#v(1em)
#align(center, [*Credenziali di utilizzo* \ Username: _admin_, Password: _admin_ \ Username: _user_, Password: _user_])

#pagebreak()

#page(numbering: none)[
    #outline(
      title: "Indice dei contenuti",
      depth: 3,
      indent: true
    )
  ]
#pagebreak()

= Introduzione 
GagGym (letto "_Gaggim_", come scherzoso gioco di parole tra il cognome della professoressa Ombretta Gaggi e il termine inglese "_Gym_") è un sito web ideato come sito di presentazione, esplorazione, iscrizione e amministrazione di una palestra, con l'obiettivo di fornire un'esperienza utente semplice e intuitiva. 

L'utente può visualizzare le informazioni essenziali della palestra, i macchinari di cui dispone, lo staff presente e procedere, qualora fosse interessato, all'iscrizione, ottenendo così accesso alla sua area riservata.

Nella sua area personale, l'utente potrà visualizzare le informazioni del profilo, la scheda di allenamenti seguita, verificare l'abbonamento sottoscritto e caricare il certificato medico da far validare dall'amministratore.
Tra le informazioni del profilo dell'utente sarà presente anche un QR code identificativo, utilizzabile per l'accesso rapido alla palestra mediante un lettore fisico dedicato, pratica ormai comune in molte palestre.

L'amministratore, invece, potrà accedere all'area amministrativa, con metriche e statistiche sulla palestra, e validare i certificati medici caricati dagli utenti e modificare gli abbonamenti offerti.

#pagebreak()

= Approccio allo sviluppo
== Mockup
La fase iniziale dei lavori ha visto come primo passo la realizzazione di un mockup del sito, per avere un punto di partenza per l'organizzazione, il contenuto e lo stile delle pagine.

Il gruppo ha utilizzato un approccio _mobile-first_, non solo perchè consapevole che la maggior parte degli accessi ad internet avviene tramite dispositivi mobili, ma anche perchè si è considerato più semplice, in fase implementativa, adattare un sito web da mobile a desktop che viceversa, dato che le dimensioni ridotte della viewport mobile potrebbero rappresentare un fattore critico se non sufficientemente considerate.

== Impatto grafico
Il gruppo ha imposto uno stile _cartoonesco_ e simpatico, con una struttura semplice e intutitiva, adoperando un lessico facilmente comprensibile e un linguaggio informale, per rendere l'esperienza utente piacevole e divertente. 

Il sito è stato progettato per essere utilizzabile da un ampio raggio di utenza, sia da coloro che già conoscono la palestra, sia da coloro che la stanno scoprendo per la prima volta. Il range di età è compreso tra i 15 e i 50 anni, considerando una maggioranza di utenti tra i 18 e i 40 anni.

= SEO 
La SEO è un elemento fondamentale per un sito web, in quanto permette di posizionarsi in modo ottimale nei risultati di ricerca, aumentando la visibilità e il traffico sul sito. GagGym intende a rispondere a ricerche come:
- GagGym (nome del sito);
- Ricerche generali su palestre;
- Ricerche in merito a corsi di fitness (yoga, pilates, ecc.);
- Ricerche in merito a macchinari ed esercizi.

Per raggiungere questo obiettivo, ogni pagina è stata progettata seguendo le _good practice_ viste a lezione:
- HTML5 valido e semanticamente corretto;
- Utilizzo di tag _meta description_ per descrivere il contenuto della pagina;
- Utilizzo di tag _meta keywords_ per descrivere le parole chiave della pagina;
- Utilizzo di tag _title_ in modo pertinente e conciso.

Trattandosi di un sito web dedicato ad una palestra, sarebbe inoltre possibile ottimizzare la SEO in modo che il sito diventi più rilevante nella zona geografica in cui si trova la palestra, in modo da raggiungere un pubblico più ristretto ma più interessato.
Il gruppo è altresì consapevole che la SEO è un processo che non termina con la pubblicazione del sito, e che il suo miglioramento dipende anche da fattori esterni come la bontà dei link d'ingresso.

#pagebreak()

= Progettazione
== Schema e struttura organizzativi
Il sito è stato progettato per essere facilmente navigabile. Si utilizza uno schema organizzativo _ambiguo_ per argomento, ove le pagine sono organizzate in base al loro contenuto interno, favorendo in questo modo l'esplorazione del sito non richiedendo all'utente di conoscere la struttura del sito. Gli argomenti risultano però ben distinti tra loro, e facilmente riconoscibili, quali: Home, Corsi, Abbonamenti, Macchinari, Staff, Area Personale.

La struttura del sito è ampia e poco profonda, permettendo non solo il raggiungimento rapido delle informazioni ricercate (con una media di 3 click per raggiungere la pagina desiderata) ma anche una manutenzione più semplice e veloce.

La navigazione tra le pagine del sito è resa possibile tramite un menù a tendina contenente 6 voci (Home, Corsi, Abbonamenti, Macchinari, Staff, Login), rispettando le _best practice_ in merito al numero di voci consigliate (non più di 7) per non appesantire l'overhead cognitivo dell'utente.

== Utenti 
Il sito è stato pensato per rispondere alle esigenze di 3 tipologie di utenti:
- *Utente non autenticato*: utente che accede al sito senza aver effettuato il login. Può visualizzare le informazioni pubbliche della palestra, i macchinari presenti e lo staff. Può inoltre registrarsi al sito, ottenendo così un account utente e la sua area personale.
- *Utente autenticato*: utente che ha effettuato il login. Può visualizzare le informazioni pubbliche della palestra, i macchinari presenti e lo staff. Può inoltre visualizzare le informazioni del proprio profilo, la scheda di allenamenti seguita, verificare l'abbonamento sottoscritto e caricare il certificato medico da far validare dall'amministratore.
- *Amministratore*: utente che ha effettuato il login con privilegi di amministratore. Può accedere all'area amministrativa, con metriche e statistiche sulla palestra, e gestire i macchinari presenti, gli utenti e la validazione dei loro certificati medici.

== Convenzioni
- Su schermi con larghezza della viewport superiore a 660px, il menù a tendina viene mostrato orizzantalmente anzichè verticalmente  per sfruttare al meglio lo spazio disponibile.

- Al fine di rimuovere i link circolari, all'interno del menù a tendina, il link che conducerà alla pagina corrente sarà sostituito da uno _span_. Questa sostituzione avviene tramite un controllo lato server, e sfrutta la natura _inline_ dello _span_, che non altera la struttura del menù. 

- L'utente amministratore non possiede una classica pagina di profilo, bensì, una volta effettuato il login, entra direttamente nella pagina di amministrazione. Questa scelta, seppur possa sembrare una rottura delle convenzioni interne, è dettata dalla distinzione netta delle due tipologie utente: l'amministratore non è un cliente della palestra, bensì ne è il gestore, e pertanto non possiede dettagli come certificato medico, scheda, QR di accesso o abbonamento, accedendo direttamente alla pagina di amministrazione. Inoltre, si assume che l'amministratore sia un utente che, in qualità di gestore, sia consapevole delle funzionalità amministrative. Per rendere evidente il cambio di contesto, non solo lo sfondo della pagina cambia, ma compare anche il testo "Admin" vicino all'_hamburger menù_ che  conterrà le nuove voci di amministrazione.

- A seguito del login, la voce corrispondente nel menù viene sostituita dallo username dell'utente loggato: siamo consapevoli che il login con username e password "_user_" possa in questo modo far mostrare la voce "_user_" nel menù, ma si tratta di un caso limite dettato dai requisiti del progetto: nell'utilizzo reale, l'utente scegliendo un username personale riconoscerà facilmente che si tratta della sua area personale.

#pagebreak()

= Implementazione
== Linguaggi utilizzati 
Il sito è stato realizzato utilizzando i seguenti linguaggi:
- HTML5: per la struttura delle pagine;
- CSS3: per la presentazione delle pagine;
- PHP: per il lato server;
- JavaScript: per il lato client.

\
== HTML5
=== Struttura e Contenuto 
La struttura del sito è stata realizzata utilizzando HTML5. Le pagine HTML sono utilizzate come template per la generazione dinamica dei contenuti mediante PHP. A tal fine è stato necessario inserire dei placeholder al loro interno per i contenuti dinamici:
- "_\@\@placeholder\@\@_" per semplici stringhe;
- "_<!-\- inizio contenuto dinamico \-\->_" e "_<!-\- fine contenuto dinamico \-\->_" per contenuti più complessi, come tabelle, cards o liste.

Questo non solo contribuisce alla leggibilità del codice, ma permette anche di distinguere facilmente i contenuti statici da quelli dinamici, creando inoltre una netta separazione tra struttura, presentazione e comportamento.
Inoltre, l'utilizzo delle pagine HTML come template per l'elaborazione dinamica dei contenuti, permette di dover contattare il server solo una volta per pagina, riducendo il carico di lavoro del server e velocizzando il caricamento delle pagine.

Durante lezioni del corso è stata evidenziata una duplice scuola di pensiero in merito all'utilizzo dei tag _\<h1>_ all'interno delle pagine:
- *Singolo _\<h1>_ nella pagina*: prevede l'utilizzo di un singolo tag _\<h1>_ tipicamente posizionato all'interno dell'_header_ e nel _main_ si riprende la titolazione utilizzando il tag _\<h2>_;
- *Duplice _\<h1>_ nella pagina*: prevede l'utilizzo di un tag _\<h1>_ per il nome del sito (GagGym) e un tag _\<h1>_ per il titolo specifico della pagina.

Il gruppo, consapevole che il primo metodo porterebbe ad un codice più puro dal punto di vista del linguaggio, ha scelto di adottare il secondo metodo, ponendo come elemento centrale l'utente e la sua esperienza.

=== Componenti
Alcune strutture e elementi all'interno delle pagine, per loro natura, non variano tra pagine diverse. Al fine di evitare la ripetizione di codice e rendere più semplice la manutenzione e l'aggiornamento del sito, il gruppo ha deciso di rendere alcuni elementi dei _"componenti"_ riusabili. La struttura di questi componenti è stata salvata in file HTML dedicati, e vengono aggiunti dinamicamente mediante PHP alla costruzione della pagina. Gli elementi resi componenti sono:
- navbar principale di navigazione (_./HTML_pages/componenti/navbar-principale.html_);
- footer (_./HTML_pages/componenti/footer.html_);
- pulsante di _scroll to top_ (_./HTML_pages/componenti/torna_su.html_);

== CSS3
Lo stile del sito è stato realizzato utilizzando CSS3 utilizzando un approccio _mobile-first_. Questo ha permesso la realizzazione di un solo file CSS per tutti i dispositivi, gestendo dapprima il layout per mobile e successivamente, mediante _media query_, per i dispositivi desktop. Seguendo le pratiche viste a lezione e in laboratorio, il gruppo si è impegnato ad organizzare il file CSS commentando le sezioni secondo la pagina a cui si riferiscono, e ad raccogliere tutte le variabili di colore in un unica sezione iniziale, in modo che la personalizzazione o l'aggiornamento dei colori, possa avvenire in modo rapido e semplice. 

Mediante CSS sono stati gestiti tutti gli aspetti decorativi, in particolare tutte le immagini che prevedevano una natura decorativa e non informativa. Allo stesso modo anche le emoji presenti nella pagina dei Corsi sono aggiunte mediante pseudo-elementi CSS come _::before_ e _::after_. 

Il gruppo inoltre ha valutato attentamente il ruolo delle immagini all'interno del sito: all'interno della homepage, le immagini che rappresentano le varie voci di navigazione sono state interpretate come decorative: difatti non rappresentano informativamente il contenuto della pagina di destinazione, ma sono unicamente un elemento decorativo che permette di rendere più piacevole la navigazione.

Lo stesso ragionamento è stato svolto per la pagina dei corsi: l'immagine del corso di yoga (ad esempio) non rappresenta informativamente il corso, ma è unicamente un elemento decorativo.

Pertanto, siccome il contenuto informativo rimane invariato anche senza l'immagine, queste sono state inserite come immagini decorative.

Al contrario, le immagini presenti nella pagina dei macchinari e dello staff sono state interpretate come contenuto facente parte della pagina stessa. L'_alt_ di queste immagini risulta vuoto in quanto il contenuto informativo è già presente nel testo della pagina.

Le immagini sono in formato _WEBP_, permettendo un miglioramento anche in termini di performance e peso della pagina. Maggiori informazioni in merito sono presenti nella sezione _Test e verifica_.

== PHP
Il lato server del sito è stato realizzato utilizzando PHP. Le pagine vengono generate dinamicamente, leggendo il contenuto delle corrispettive pagine HTML e sostituendo i placeholder con i contenuti dinamici.
L'utilizzo principale di PHP risiede nel collegamento con il database, la creazione della sessione, la generazione dinamica delle pagine e la gestione dei form. In particolare, per la gestione dei form, è stato utilizzato un approccio mediante il quale i dati inseriti dall'utente vengono processati in una pagina PHP dedicata, che si occupa di validare i dati e di restituire eventuali errori, che vengono mostrati all'utente nella pagina di origine. Esempi di questo approccio possono essere la pagina di _login_ e la pagina di _registrazione_, dove i form presenti richiamano le rispettive pagine PHP _login_handler.php_ e _registrazione_handler.php_.

=== Costruzione delle pagine
Per la costruzione delle pagine, si utilizza un file PHP dedicato, _pages_builder.php_, il quale, determinato il nome della pagina richiesta, legge il contenuto della pagina HTML corrispondente e ne costruisce l'impianto iniziale. Successivamente, questo contenuto viene restituito alla pagina che ne ha richiesto la costruzione, che si occuperà di sostituire i placeholder con i contenuti dinamici.

=== Collegamento database
Per il collegamento al database, è prevista una classe dedicata, _db_handler.php_, che si occupa non solo di stabilire la connessione al database, ma anche di effettuare le query necessarie: questo permette la gestione centralizzata della logica di comunicazione con il database, rendendo più semplice e veloce la manutenzione del codice.

=== SQL injection
Per prevenire attacchi di tipo SQL injection, il gruppo ha utilizzato le _prepared statements_ per tutte le query. Questo approccio permette di separare la query SQL dalla sua esecuzione, evitando che i dati forniti dall'utente possano essere interpretati come codice SQL.

=== Librerie esterne
Il progetto fa utilizzo di 2 librerie PHP esterne:
- _phpQRcode_: libreria per la generazione di QR code identificativo dell'utente;
- _jpgraph_: libreria per la generazione di grafici e metriche per la schermata dell'amministratore. 

== Javascript
Il gruppo ha reso il sito fruibile anche in assenza di Javascript, utilizzandolo solamente per la validazione dei dati lato client. Il menù a tendina infatti, è impostato per essere mostrato aperto di default, e al caricamento della pagina, esso viene chiuso tramite Javascript. In questo modo, se Javascript è disabilitato, le funzionalità di navigazione rimangono comunqe disponibili, e l'intero utilizzo del sito rimane possibile. 

Si osserva però che tale soluzione non è ottimale, in quanto il servizio LightHouse di Google segnala un calo di performance su mobile, dovuto ad un problema di _cumulative layout shift_ (CLS), causato dal caricamento del menù aperto e successivamente chiuso.

== Validazione input utente
Per la validazione dei dati inseriti dall'utente, il gruppo ha impostato i medesimi controlli sia lato client che lato server, mostrando all'utente gli errori riscontrati in modo che possa essere consapevole della motivazione che ha portato alla generazione dell'errore.

Gli script di validazione lato client sono situati all'interno della cartella _./scripts_, aventi nome significativo in base al compito di validazione che svolgono.

Per la validazione lato server, il compito è demandato al file _./server_side_validator.php_, il quale fornisce funzioni di validazione mediante le quali è possibile ottenere l'eventuale messaggio di errore da mostrare all'utente.

Il messaggio di errore è cumulativo, pertanto, al presentarsi di più errori in un singolo form, il messaggio di errore mostrato indicherà tutti gli errori riscontrati, in modo che l'utente possa sapere con certezza le motivazioni dell'errore e come risolvere.

== Database
Il database rispetta i vinvoli dettati dalla consegna (terza forma normale). All'interno della cartella è presente il file ./rcarraro.sql per l'importazione del database. 
=== Schema
Il database è composto da 10 tabelle:
- *utenti*: contiene le informazioni degli utenti registrati al sito;
- *abbonamenti*: contiene le informazioni sugli abbonamenti offerti dalla palestra;
- *utenti_abbonamenti*: contiene le informazioni sugli abbonamenti sottoscritti dagli utenti;
- *scheda*: contiene le informazioni sulle schede di allenamento;
- *esercizi*: contiene le informazioni sugli esercizi;
- *schede_esercizi*: contiene le informazioni sugli esercizi presenti nelle schede di allenamento;
- *schede_utenti*: contiene le informazioni sulle schede di allenamento seguite dagli utenti;
- *macchinari*: contiene le informazioni sui macchinari presenti nella palestra;
- *allenatori*: contiene le informazioni sugli allenatori della palestra;
- *gruppimuscolari*: contiene elenco dei gruppi muscolari a cui gli esercizi fanno riferimento.



== Pagine di errore
Al fine di migliorare l'esperienza utente, il gruppo ha deciso di implementare delle pagine di errore personalizzate, che vengono mostrate all'utente in caso di errore 404 o 500. Questo permette di mantenere l'utente all'interno del sito, evitando che venga reindirizzato ad una pagina di errore generica del browser. Le pagine di errore contengono un messaggio di errore semplice e simpatico, in tema con il sito, con suggerimenti in merito a come risolvere il problema.

Data la natura delle pagine di errore ben distinta dalle pagine di navigazione, il gruppo ha deciso di non mostrare la breadcrumb in queste pagine, fornendo però tutti i mezzi necessari per riprendere la navigazione, quali _header_ (con il menù di navigazione principale) e il _footer_.

#pagebreak()

= Accessibilità
== Font
Il font utilizzato è _Oswald_, un font _sans serif_ che supporta un ampio range di lingue, compresi alfabeti non latini come il cirillico. Al fine di rendere l'esperienza utente più piacevole, il testo possiede sempre dimensioni superiori ai 16pixels (12pt).

== Colori e Contrasti
La palette di colori utilizzata è stata scelta con attenzione al fine di permettere un contrasto sufficiente tra testo e sfondo, e di distinguere nitidamente gli elementi presenti nella pagina. Ogni contrasto testo/background è stato verificato essere superiore a 7:1 (richiesto per il livello AAA di WCAG). Si osserva che il contrasto tra testo e sfondo è stato verificato utilizzando il tool _Color Contrast Checker_ di WebAIM.

Sfortunatamente, il contrasto tra il colore dei link visitati e il color dei link non visitati, non presenta un contrasto sufficiente: seppur in entrambi i casi il contrasto con lo sfondo sia superiore a 7:1, il contrasto tra i due colori è inferiore a 3:1. 

== Ulteriori accorgimenti
- *Navigazione mediante tastiera*: il sito è navigabile mediante tastiera, utilizzando la tabulazione per spostarsi tra i vari elementi della pagina in modo coerente al contenuto presentato. Viene inoltre data la possibilità di saltare la navigazione e accedere direttamente al contenuto della pagina mediante un link posto come primo elemento del body con classe _skip-content_.
- *Utilizzo di attributi _aria_*: al fine di migliorare l'accessibilità del sito, sono stati utilizzati gli attributi _ARIA_ per fornire informazioni aggiuntive agli screen reader. Un esempio è il menù a tendina, che fa utilizzo dell'attributo _aria-expanded_ per indicare se il menù è aperto o chiuso.
- *Tabelle accessibili* seguendo le _best practice_ viste a lezione.
- *_\<span lang="en">_*: per le parole in lingua inglese, è stato utilizzato l'attributo _lang="en"_ per indicare la lingua utilizzata, in modo da permettere agli screen reader di leggere correttamente il testo. 
- *Classe _screen-reader-only_*: per permettere agli screen reader di leggere il contenuto di un elemento, senza che questo sia visibile all'utente, è stata utilizzata la classe _screen-reader-only_, che rende l'elemento non visibile graficamente, ma non nascosto agli screen reader.

#pagebreak()

= Test e verifica
Il sito è stato sottoposto a diversi test atti a verificarne sia il funzionamento che la correttezza e validità del codice.
Strumenti fondamentali durante la fase di test sono stati:
- *Total Validator*: per la validazione del codice, utilizzando come parametro _WCAG22 AAA_;
  - la validazione ha restituito 0 errori e 0 warning per ogni pagina del sito.

- *W3C Markup Validation Service*: per la validazione del codice HTML:
  - la validazione ha restituito 0 errori e 0 warning, ma un alcuni _info_ dovuti agli  _slash \/_ finali dei tag meta e link, ma abbiamo visto a lezione essere buona pratica chiudere ogni tag.

- *W3C CSS Validation Service*: per la validazione del codice CSS;
  - la validazione ha restituito 0 errori e 0 warning.

- *Contrast Checker di WebAIM*: per la verifica del contrasto tra testo e sfondo;
  - il contrasto tra testo e sfondo è sempre superiore a 7:1.

- *LightHouse* di Google Chrome: per la verifica delle performance, accessibilità, SEO e _best_practice_ del sito:
  - Media Performance: 80% (per i motivi descritti in precedenza riguardo al menù a tendina nella versione mobile) e circa 100% per la versione desktop;
    - Per migliorare le performance, il sito utilizza immagini in formato _WEBP_, che permette di ridurre le dimensioni delle immagini senza perdita di qualità, risultando più leggere di _PNG_ e _JPEG_. Le immagini inoltre sono state ulteriormente ottimizzate tramite strumenti come _TinyPNG_ e _Simple Image Resizer_, con nessuna immagine che supera i 100KB di peso. L'utilizzo del formato _WEBP_ è stato giustificato anche dal supporto di questo formato dal 97% dei browser, come riportato da _caniuse.com_.
  - Media Accessibility: 100% (mobile e desktop);
  - Media Best Practice: 100% (mobile e desktop);
  - Media SEO: 100% (mobile e desktop);

- *Screen reader*: per la verifica dell'accessibilità del sito:
    - Assistente vocale di Windows;
    - Voice Over di MacOS;
    - NVDA: il gruppo ci tiene a precisare però che l'inesperienza nell'utilizzo di uno screen reader come NVDA ha permesso sì una verifica del sito, ma sicuramente non esaustiva. L'obiettivo principale era riuscire a navigare il sito, traendo le informazioni relative a contenuto e stato degli elementi (come lo stato del menù a tendina, ad esempio). Seppur questi obiettivi siano stati raggiunti, il gruppo è consapevole che solo un utente più abile nell'utilizzo di uno screen reader avrebbe potuto fornire un riscontro più completo e dettagliato.

- *Compatibilità browser*: per la verifica della compatibilità del sito con i principali browser:
    - Google Chrome (desktop e mobile);
    - Mozilla Firefox (desktop e mobile);
    - Microsoft Edge;
    - Safari (desktop e mobile);
    - Opera;
    - Samsung Internet.
  Si osserva inoltre che i test non sono stati effettuati solamente su _desktop_ o su dispositivi simulati, ma anche su diversi dispositivi fisici posseduti dal gruppo, in modo da avere un riscontro quanto più realistico possibile.

#pagebreak()

= Suddivisione dei lavori
== Riccardo Carrarro
- Pagine HTML e rispettivo PHP:
  - index;
  - login (e relativi handler);
  - registrazione (e relativi handler);
  - profile_profilo;
  - profile_profilo_edit;
  - compra_abbonamento;
  - admin_landing;
  - admin_amministrazione;
  - strutturazione del database;
  - creazione query necessarie alle pagine sopra citate;
  - CSS relativo alle pagine sopra citate;
  - validazione lato server e client per le pagine sopra citate;

== Endi Hysa
- Pagine HTML e rispettivo PHP:
  - chi_siamo;
  - contattaci;
  - pagine di errore (404 e 500);
  - profile_certificato;
  - creazione query necessarie alle pagine realizzate;
  - CSS relativo alle pagine sopra citate;
  - validazione lato server e client per le pagine sopra citate;

== Andrea Giurisato
- Pagine HTML e rispettivo PHP:
  - corsi;
  - abbonamenti;
  - profile_abbonamenti;
  - scelta delle immagini per la parte grafica;
  - creazione query necessarie alle pagine sopra citate;
  - CSS relativo alle pagine sopra citate;
  - validazione lato server e client per le pagine sopra citate;

== Michele Ogniben
- Pagine HTML e rispettivo PHP:
  - macchinari;
  - schede;
  - profile_schede;
  - creazione query necessarie alle pagine sopra citate;
  - CSS relativo alle pagine sopra citate;
  - validazione lato server e client per le pagine sopra citate;

Ogni membro ha altresì contribuito alla stesura della relazione, alla verifica e al test del sito.