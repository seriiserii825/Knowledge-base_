# Reguli de scriere HTML și CSS

## 1. Reguli HTML de bază

- Definiți întotdeauna culoarea de fundal pentru corp, chiar dacă este alb.
- Numele și ID-urile claselor trebuie să fie semnificative pentru utilizarea lor preconizată (de exemplu, header, meniu, subsol, știri).
- Toate imaginile trebuie să aibă un atribut alt.
- Imaginile decorative trebuie să aibă un atribut alt="" gol.
- Fiecare pagină are un <title> și o <meta description> unice.
- Fiecare pagină are un <h1> unic.
- Titlurile sunt structurate și ordonate (H1 → H2 → H3).

---

## 2. Text și conținut

- Fără bloatware (Lorem ipsum, substituenți).
- Fără greșeli de ortografie.
- Contrastul textului respectă WCAG (nu se amestecă cu fundalul).
- Aspectele grilă și bloc nu se întrerup cu cuvinte foarte lungi (de exemplu, în germană).
- Testat pentru conținut gol și excesiv de lung.

---

## 3. CSS și stiluri

- Elementele unde textul ar trebui să fie pe o singură linie sunt setate la `white-space: nowrap`.
- Butoanele (nu `input`) sunt setate la `cursor: pointer`.
- Stările active (`:active`) pentru butoane/linkuri sunt stilizate.
- Stările de focalizare (`:focus`) sunt vizibile pentru toate elementele interactive.
- Nu există scroll orizontală pe dispozitivele mobile.

---

## 4. Linkuri și navigare

- Toate meniurile sunt funcționale, cu efecte de hover și clic (`hover`, `active`).
- Logoul din header face legătura către pagina principală. - Linkurile externe au `target="_blank"` și `rel="noopener noreferrer"`.
- Nu există linkuri rupte.
- Se utilizează formate corecte pentru `tel:` și `mailto:` (`tel:+373...`, `mailto:...@...`).
- Linkurile ancoră interne (`#id`) indică către elemente existente.

---

## 5\. Formulare și ferestre popup

- Toate formularele funcționează, erorile sunt evidențiate.
- Ferestrele popup pot fi închise cu ușurință (cruce, clic în afara ferestrei, Esc).

---

## 6\. Media și imagini

- Imaginile sunt încărcate în mod lenjerie (`loading="lazy"`) și nu perturbă aspectul.
- Toate imaginile sunt optimizate (comprimate, dimensionate corect, fără fotografii de previzualizare uriașe).

---

## 7\. JS și interactiv

- Nu există erori în consola browserului.
- Sliderele, galeriile și acordeoanele funcționează corect atunci când fereastra este redimensionată.
- Nu există zone inactive - zonele pe care se poate face clic se aliniază cu elementele vizuale.
