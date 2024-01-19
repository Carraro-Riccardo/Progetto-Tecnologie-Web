
#set page(
  numbering: "1",
  number-align: center,
  paper: "a4",
  margin: (x: 2cm, y: 2.5cm),
)
#set heading(
  numbering: "1.1",
)

#align(center,image("./imgs/logo.png", width: 15em, height: 15em))
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
    [2042346], [Endi  Hysa], [riccardo.carraro.10\@studenti.unipd.it],
    [2042346], [Andrea Giurisato], [riccardo.carraro.10\@studenti.unipd.it],
    [2042346], [Michele Ogniben], [riccardo.carraro.10\@studenti.unipd.it],
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

L'amministratore, invece, potrà accedere all'area amministrativa, con metriche e statistiche sulla palestra, e gestire i macchinari presenti, gli utenti e la validazione dei loro certificati medici.

#pagebreak()

= Approccio allo sviluppo
== Mockup
La fase iniziale dei lavori ha visto come primo passo la realizzazione di un mockup del sito, per avere un punto di partenza per l'organizzazione, il contenuto e lo stile delle pagine. 
Il gruppo ha utilizzato un approccio _mobile-first_, non solo perchè consapevole che la maggior parte degli accessi ad internet avviene tramite dispositivi mobili, ma anche perchè risulta più semplice, in fase implementativa, adattare un sito web da mobile a desktop che viceversa, dato che le dimensioni ridotte della viewport mobile potrebbero rappresentare un fattore critico se non sufficientemente considerate.

== Impatto grafico
Il gruppo ha imposto uno stile _cartoonesco_ e simpatico, con una struttura semplice e intutitiva, adoperando un lessico facilmente comprensibile e un linguaggio informale, per rendere l'esperienza utente più piacevole e divertente. 

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

Il gruppo è altresì consapevole che la SEO è un processo che non termina con la pubblicazione del sito, e che il suo miglioramento dipende anche da fattori esterni come la bontà dei link d'ingresso.

#pagebreak()

= Progettazione
== Schema organizzativo e struttura
Il sito è stato progettato per essere facilmente navigabile. Si utilizza uno schema organizzativo esatto, che predispone ogni elemento in modo coerente identificando i contenuti in modo chiaro ed evidente (corsi, abbonamenti, macchinari, schede, staff).

La struttura del sito è ampia e poco profonda, permettendo non solo il raggiungimento rapido delle informazioni ricercate (con una media di 3 click per raggiungere la pagina desiderata) ma anche una manutenzione più semplice e veloce.

La navigazione tra le pagine del sito è resa possibile tramiete un menù a tendina contenente 6 voci (Home, Corsi, Abbonamenti, Macchinari, Staff, Login), rispettando le _best practice_ in merito al numero di voci consigliate (non più di 7) per non appesantire l'overhead cognitivo dell'utente.

== Utenti 
Il sito è stato pensato per rispondere alle esigenze di 3 tipologie di utenti:
- *Utente non autenticato*: utente che accede al sito senza aver effettuato il login. Può visualizzare le informazioni pubbliche della palestra, i macchinari presenti e lo staff. Può inoltre registrarsi al sito, ottenendo così un account utente e la sua area personale.
- *Utente autenticato*: utente che ha effettuato il login. Può visualizzare le informazioni pubbliche della palestra, i macchinari presenti e lo staff. Può inoltre visualizzare le informazioni del proprio profilo, la scheda di allenamenti seguita, verificare l'abbonamento sottoscritto e caricare il certificato medico da far validare dall'amministratore.
- *Amministratore*: utente che ha effettuato il login con privilegi di amministratore. Può accedere all'area amministrativa, con metriche e statistiche sulla palestra, e gestire i macchinari presenti, gli utenti e la validazione dei loro certificati medici.

== Convenzioni interne 
- Su schermi con larghezza della viewport superiore a 660px, il menù a tendina viene mostrato orizzantalmente anzichè verticalmente, per sfruttare al meglio lo spazio disponibile.

- All'interno dell'header, il logo della palestra rispetta la convenzione esterna di essere cliccabile e di condurre alla homepage. Questo approccio creerebbe una ripetizione del link, presente sia nel logo che nel nome della palestra presente nella nav-bar principale. Per agevolare la navigazione del sito agli utenti utilizzatori di screen reader (o di navigazione da tastiera (tab)) è stato deciso di mantenere il link anche nel logo, ma di nasconderlo allo screen reader e alla tabulazione per evitare ripetizioni. Questo è stato possibile tramite l'attributo `aria-hidden="true"` e `tabindex="-1"`. 

- Al fine di rimuovere i link circolari, all'interno del menù a tendina, il link che conducerà alla pagina corrente sarà sostituito da uno span. Questa sostituzione avviene tramite un controllo lato server, e sfrutta la natura _inline_ dello span, che non altera la struttura del menù. 

- L'utente amministratore non possiede una classica pagina di profilo, bensì, una volta effettuato il login, entra direttamente nella pagina di amministrazione. Questa scelta, seppur possa sembrare una rottura delle convenzioni interne, è dettata dalla distinzione netta delle due tipologie utente: l'amministratore non è un cliente della palestra, bensì ne è il gestore, e pertanto non possiede dettagli come certificato medico, scheda, qr di accesso o abbonamento, accedendo direttamente alla pagina di amministrazione. Inoltre, si assume che l'amministratore sia un utente che, in qualità di gestore, sia consapevole delle funzionalità amministrative. Per rendere evidente il cambio di contesto, non solo lo sfondo della pagina cambia, ma anche il testo del menù a tendina, da "Menù" diventa "Menù admin", contenendo le nuove voci di amministrazione.

- A seguito del login, la voce corrispondente nel menù viene sostituita dallo username dell'utente loggato: siamo consapevoli che il login con username e password "_user_" possa in questo modo far mostrare la voce "_user_" nel menù, ma si tratta di un caso limite dettato dai requisiti del progetto.

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
La struttura del sito è stata realizzata utilizzando HTML5. Le pagine html sono utilizzate come template per la generazione dinamica dei contenuti, utilizzando PHP, pertanto è stato necessario inserire dei placeholder per i contenuti dinamici:
- "_\@\@placeholder\@\@_" per semplici stringhe;
- "_<!-\- inizio contenuto dinamico \-\->_" e "_<!-\- fine contenuto dinamico \-\->_" per contenuti più complessi, come tabelle, cards o liste.

Questo non solo contribuisce alla leggibilità del codice, ma permette anche di distinguere facilmente i contenuti statici da quelli dinamici, creando inoltre una netta separazione tra struttura, presentazione e comportamento.
Inoltre, l'utilizzo delle pagine html come template per l'elaborazione dinamica dei contenuti, permette di dover contattare il server solo una volta per pagina, riducendo il carico di lavoro del server e velocizzando il caricamento delle pagine.

=== Componenti
Alcuni elementi comuni delle pagine sono stati resi componenti, ossia salvati come file html separati e aggiunti dinamicamente alle pagine tramite PHP, sfruttando i placeholder precedentemente descritti. 
Questo approccio permette di evitare la ripetizione di codice, rendendo anche più semplici eventuali modifiche a componenti condivisi. Gli elementi resi componenti sono:
- navbar principale di navigazione (_./html_pages/componenti/navbar-principale.html_);
- footer (_./html_pages/componenti/footer.html_);

== CSS3
Lo stile del sito è stato realizzato utilizzando CSS3 utilizzando un approccio _mobile-first_. Questo ha permesso la realizzazione di un solo file CSS per tutti i dispositivi, gestendo dapprima il layout per mobile e successivamente, mediante _media query_, per i dispositivi desktop. Seguendo le pratiche viste a lezione e in laboratorio, il gruppo si è impegnato ad organizzare il file CSS commentando le sezioni secondo la pagina a cui si riferiscono, e ad raccogliere tutte le variabili di colore in un unica sezione iniziale, in modo che la personalizzazione o l'aggiornamento dei colori, possa avvenire in modo rapido e semplice. 

Mediante CSS sono stati gestiti tutti gli aspetti decorativi, in particolare tutte le immagini che prevedevano una natura decorativa e non informativa. Allo stesso modo anche le emoji presenti nella pagina dei corsi sono aggiunte mediante pseudo-elementi CSS come `::before` e `::after`. 

Il gruppo inoltre ha valutato attentamente il ruolo delle immagini all'interno del sito: all'interno della homepage, le immagini che rappresentano le varie voci di navigazione sono state interpretate come decorative: difatti non rappresentano informativamente il contenuto della pagina di destinazione, ma sono unicamente un elemento decorativo che permette di rendere più piacevole la navigazione.

Lo stesso ragionamento è stato svolto per la pagina dei corsi: l'immagine del corso di yoga (ad esempio) non rappresenta informativamente il corso, ma è unicamente un elemento decorativo.

Pertanto, siccome il contenuto informativo rimane invariato anche senza l'immagine, queste sono state inserite come immagini decorative.

Al contrario, le immagini presenti nella pagina dei macchinari e dello staff sono state interpretate come informative: difatti rappresentano informativamente il contenuto della pagina e del contenuto riferito, e sono pertanto state inserite come tag `<img>` (il macchinario nell'immagine è l'unità informativa ricercata e concreta).

== PHP
Il lato server del sito è stato realizzato utilizzando PHP. Le pagine vengono generate dinamicamente, leggendo il contenuto delle corrispettive pagine html e sostituendo i placeholder con i contenuti dinamici.

== Pagine di errore



