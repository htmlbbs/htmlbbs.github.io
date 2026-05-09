import React, { useMemo, useState } from "react";

// A2 Präpositionen – Interaktive Übungen (Single-file React app)
// Styling: TailwindCSS utility classes
// Hinweise: Alle Inhalte sind für Niveau A2 gestaltet und geben direktes Feedback.

function Chip({ children }) {
  return (
    <span className="px-2 py-0.5 text-xs rounded-full bg-slate-100 border border-slate-200">
      {children}
    </span>
  );
}

function Card({ title, children, footer }) {
  return (
    <div className="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
      <div className="flex items-center justify-between mb-3">
        <h3 className="text-lg font-semibold">{title}</h3>
      </div>
      <div>{children}</div>
      {footer ? <div className="mt-4 pt-3 border-t border-slate-100">{footer}</div> : null}
    </div>
  );
}

function CheckIcon({ ok }) {
  return (
    <span aria-hidden className={"ml-2 inline-block w-2.5 h-2.5 rounded-full " + (ok ? "bg-green-500" : "bg-rose-500")} />
  );
}

function ResultBadge({ correct, show }) {
  if (!show) return null;
  return (
    <span className={"ml-2 text-xs font-medium " + (correct ? "text-green-700" : "text-rose-700") }>
      {correct ? "Richtig!" : "Noch nicht."}
    </span>
  );
}

// Übung 1: Lückentext (einfache Präposition wählen)
const gapItems = [
  { id: 1, textBefore: "Ich fahre ", options: ["nach", "zu", "in"], answer: "nach", textAfter: " Berlin." },
  { id: 2, textBefore: "Er kommt ", options: ["aus", "von", "bei"], answer: "aus", textAfter: " der Schweiz." },
  { id: 3, textBefore: "Ich wohne ", options: ["bei", "zu", "an"], answer: "bei", textAfter: " meinen Eltern." },
  { id: 4, textBefore: "Wir gehen ", options: ["zu", "nach", "von"], answer: "zu", textAfter: " dem Arzt." },
  { id: 5, textBefore: "Das Geschenk ist ", options: ["für", "ohne", "gegen"], answer: "für", textAfter: " dich." },
  { id: 6, textBefore: "Kann ich ", options: ["mit", "ohne", "aus"], answer: "mit", textAfter: " dir kommen?" },
];

// Übung 2: Wechselpräpositionen – Bewegung oder Position?
const wechselItems = [
  {
    id: 1,
    sentence: "Ich stelle das Buch ___ den Tisch.",
    choices: [
      { label: "auf + Akkusativ (Bewegung)", key: "Akk" },
      { label: "auf + Dativ (Position)", key: "Dat" },
    ],
    answer: "Akk",
    tip: "Stellen = Bewegung → Akkusativ",
  },
  {
    id: 2,
    sentence: "Das Buch liegt ___ dem Tisch.",
    choices: [
      { label: "auf + Akkusativ (Bewegung)", key: "Akk" },
      { label: "auf + Dativ (Position)", key: "Dat" },
    ],
    answer: "Dat",
    tip: "Liegen = Position → Dativ",
  },
  {
    id: 3,
    sentence: "Wir hängen das Bild ___ die Wand.",
    choices: [
      { label: "an + Akkusativ (Bewegung)", key: "Akk" },
      { label: "an + Dativ (Position)", key: "Dat" },
    ],
    answer: "Akk",
    tip: "Hängen (aktiv) = Bewegung → Akkusativ",
  },
  {
    id: 4,
    sentence: "Das Bild hängt ___ der Wand.",
    choices: [
      { label: "an + Akkusativ (Bewegung)", key: "Akk" },
      { label: "an + Dativ (Position)", key: "Dat" },
    ],
    answer: "Dat",
    tip: "Hängt (Zustand) = Position → Dativ",
  },
];

// Übung 3: Sortieren – Welche Präposition gehört wohin?
const akkusativ = ["für", "ohne", "gegen", "um", "durch"];
const dativ = ["mit", "nach", "bei", "seit", "von", "zu", "aus"];
const wechsel = ["an", "auf", "in", "neben", "über", "unter", "vor", "hinter", "zwischen"];

function useShuffled(list) {
  return useMemo(() => list.slice().sort(() => Math.random() - 0.5), []);
}

function Header() {
  return (
    <header className="sticky top-0 z-10 backdrop-blur bg-white/70 border-b border-slate-200">
      <div className="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <div className="flex items-center gap-2">
          <div className="w-8 h-8 rounded-xl bg-slate-900 text-white grid place-items-center font-bold">A2</div>
          <h1 className="text-xl font-semibold">Präpositionen – Interaktive Übungen</h1>
        </div>
        <div className="hidden md:flex items-center gap-2 text-sm text-slate-600">
          <Chip>Niveau: A2</Chip>
          <Chip>Deutsch</Chip>
          <Chip>Selbstkontrolle</Chip>
        </div>
      </div>
    </header>
  );
}

function Footer() {
  return (
    <footer className="mt-12 py-8 text-center text-sm text-slate-500">
      © {new Date().getFullYear()} – Lernseite für Präpositionen (A2). Erstellt mit ❤️.
    </footer>
  );
}

function Hero({ onStart }) {
  return (
    <section className="bg-gradient-to-br from-slate-50 to-white">
      <div className="max-w-6xl mx-auto px-4 py-10 lg:py-14 grid lg:grid-cols-2 gap-8 items-center">
        <div>
          <h2 className="text-3xl md:text-4xl font-semibold leading-tight">
            Trainiere deutsche <span className="text-slate-900">Präpositionen</span> mit sofortigem Feedback
          </h2>
          <p className="mt-4 text-slate-600">
            Drei kurze Übungen: Lückentexte, Wechselpräpositionen (Akkusativ/Dativ) und Sortieren nach Fall.
            Ideal für A2 – mit Tipps, Lösungen und Punktestand.
          </p>
          <div className="mt-6 flex flex-wrap gap-3">
            <button onClick={onStart} className="px-4 py-2 rounded-xl bg-slate-900 text-white hover:opacity-90">
              Jetzt starten
            </button>
            <a href="#theorie" className="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-50">
              Kurzgrammatik
            </a>
          </div>
        </div>
        <div className="lg:justify-self-end">
          <div className="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <ul className="space-y-2 text-sm text-slate-700">
              <li>• <b>nach</b> + Länder/Städte ohne Artikel: „Ich fahre <i>nach</i> Berlin.“</li>
              <li>• <b>aus</b> + Dativ: Herkunft – „Er kommt <i>aus</i> der Schweiz.“</li>
              <li>• <b>zu</b> + Dativ: Personen/Orte – „Wir gehen <i>zu</i> dem Arzt.“</li>
              <li>• Wechselpräpositionen: Bewegung → Akk., Position → Dat.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  );
}

function Progress({ score, total }) {
  const pct = Math.round((score / total) * 100);
  return (
    <div className="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
      <div className="h-2 bg-slate-900" style={{ width: `${pct}%` }} />
    </div>
  );
}

export default function App() {
  const [started, setStarted] = useState(false);
  const [showSolutions, setShowSolutions] = useState(false);

  // Ü1
  const [answers1, setAnswers1] = useState({});
  const total1 = gapItems.length;
  const correct1 = gapItems.reduce((acc, it) => acc + ((answers1[it.id] || "") === it.answer ? 1 : 0), 0);

  // Ü2
  const [answers2, setAnswers2] = useState({});
  const total2 = wechselItems.length;
  const correct2 = wechselItems.reduce((acc, it) => acc + ((answers2[it.id] || "") === it.answer ? 1 : 0), 0);

  // Ü3 (Sortieren per Klick)
  const pool = useShuffled([...akkusativ, ...dativ, ...wechsel]);
  const [assign, setAssign] = useState({}); // word -> bucket
  const total3 = pool.length;
  const correct3 = pool.reduce((acc, w) => {
    const b = assign[w];
    if (!b) return acc;
    if (b === "Akk" && akkusativ.includes(w)) return acc + 1;
    if (b === "Dat" && dativ.includes(w)) return acc + 1;
    if (b === "Wechsel" && wechsel.includes(w)) return acc + 1;
    return acc;
  }, 0);

  const total = total1 + total2 + total3;
  const score = correct1 + correct2 + correct3;

  function resetAll() {
    setAnswers1({});
    setAnswers2({});
    setAssign({});
    setShowSolutions(false);
    setStarted(false);
  }

  return (
    <div className="min-h-screen bg-gradient-to-b from-white to-slate-50 text-slate-900">
      <Header />
      <main className="max-w-6xl mx-auto px-4 py-8">
        <Hero onStart={() => setStarted(true)} />

        <section className="mt-6 flex items-center gap-4">
          <div className="text-sm text-slate-700">Punktestand: <b>{score}</b> / {total}</div>
          <div className="flex-1"><Progress score={score} total={total} /></div>
          <button onClick={() => setShowSolutions((v) => !v)} className="px-3 py-2 rounded-xl border border-slate-300 hover:bg-slate-50 text-sm">
            {showSolutions ? "Lösungen ausblenden" : "Lösungen zeigen"}
          </button>
          <button onClick={resetAll} className="px-3 py-2 rounded-xl bg-slate-900 text-white text-sm">Zurücksetzen</button>
        </section>

        {/* Übung 1 */}
        <section className="mt-8 grid lg:grid-cols-2 gap-6">
          <Card
            title={<span>Übung 1: Lückentext <Chip>A2</Chip></span>}
            footer={<p className="text-sm text-slate-600">Wähle die passende Präposition.</p>}
          >
            <ul className="space-y-3">
              {gapItems.map((it) => {
                const sel = answers1[it.id] || "";
                const correct = sel === it.answer;
                return (
                  <li key={it.id} className="p-3 rounded-xl border border-slate-200 bg-white">
                    <div className="flex flex-wrap items-center gap-2">
                      <span>{it.textBefore}</span>
                      <select
                        className={"px-3 py-2 rounded-xl border " + (sel ? (correct ? "border-green-400" : "border-rose-300") : "border-slate-300")}
                        value={sel}
                        onChange={(e) => setAnswers1((s) => ({ ...s, [it.id]: e.target.value }))}
                      >
                        <option value="" disabled>— auswählen —</option>
                        {it.options.map((op) => (
                          <option key={op} value={op}>{op}</option>
                        ))}
                      </select>
                      <span>{it.textAfter}</span>
                      <ResultBadge correct={correct} show={!!sel} />
                      {showSolutions && !sel && (
                        <span className="ml-2 text-xs text-slate-500">Lösung: <b>{it.answer}</b></span>
                      )}
                    </div>
                  </li>
                );
              })}
            </ul>
          </Card>

          {/* Übung 2 */}
          <Card
            title={<span>Übung 2: Wechselpräpositionen <Chip>Akk./Dat.</Chip></span>}
            footer={<p className="text-sm text-slate-600">Bewegung → Akkusativ | Position → Dativ</p>}
          >
            <ul className="space-y-3">
              {wechselItems.map((it) => {
                const sel = answers2[it.id] || "";
                const correct = sel === it.answer;
                return (
                  <li key={it.id} className="p-3 rounded-xl border border-slate-200 bg-white">
                    <div className="mb-2 font-medium">{it.sentence}</div>
                    <div className="flex flex-wrap gap-2">
                      {it.choices.map((c) => (
                        <button
                          key={c.key}
                          className={"px-3 py-2 rounded-xl border text-sm " + (sel === c.key ? (correct ? "border-green-400 bg-green-50" : "border-rose-300 bg-rose-50") : "border-slate-300 hover:bg-slate-50")}
                          onClick={() => setAnswers2((s) => ({ ...s, [it.id]: c.key }))}
                        >
                          {c.label}
                          {sel === c.key && <CheckIcon ok={correct} />}
                        </button>
                      ))}
                      <ResultBadge correct={correct} show={!!sel} />
                      {sel && !correct && (
                        <span className="ml-2 text-xs text-slate-500">Tipp: {it.tip}</span>
                      )}
                      {showSolutions && !sel && (
                        <span className="ml-2 text-xs text-slate-500">Lösung: <b>{it.answer}</b></span>
                      )}
                    </div>
                  </li>
                );
              })}
            </ul>
          </Card>
        </section>

        {/* Übung 3 */}
        <section className="mt-8">
          <Card
            title={<span>Übung 3: Sortieren nach Fall <Chip>Akkusativ</Chip> <Chip>Dativ</Chip> <Chip>Wechsel</Chip></span>}
            footer={<p className="text-sm text-slate-600">Klicke zuerst eine Präposition (oben), dann einen Bereich (unten), um sie zuzuordnen. Nochmal klicken = entfernen.</p>}
          >
            <div className="grid md:grid-cols-4 gap-4">
              <div className="md:col-span-4">
                <div className="flex flex-wrap gap-2">
                  {pool.map((w) => {
                    const bucket = assign[w];
                    return (
                      <span key={w} className={"select-none cursor-pointer px-3 py-1.5 rounded-xl border text-sm " + (bucket ? "bg-slate-900 text-white border-slate-900" : "border-slate-300 hover:bg-slate-50")}
                        onClick={() => {
                          // toggle cycle: undefined -> Akk -> Dat -> Wechsel -> undefined
                          const order = [undefined, "Akk", "Dat", "Wechsel"];
                          const idx = order.indexOf(bucket);
                          const next = order[(idx + 1) % order.length];
                          setAssign((s) => ({ ...s, [w]: next }));
                        }}
                      >
                        {w}
                      </span>
                    );
                  })}
                </div>
              </div>

              {(["Akk", "Dat", "Wechsel"]).map((b) => (
                <div key={b} className="bg-slate-50 rounded-2xl border border-slate-200 p-4">
                  <div className="flex items-center justify-between mb-2">
                    <div className="font-medium">{b === "Akk" ? "Akkusativ" : b === "Dat" ? "Dativ" : "Wechselpräpositionen"}</div>
                    <div className="text-xs text-slate-500">
                      {b === "Akk" && "für, ohne, gegen, um, durch"}
                      {b === "Dat" && "mit, nach, bei, seit, von, zu, aus"}
                      {b === "Wechsel" && "an, auf, in, neben, über, unter, vor, hinter, zwischen"}
                    </div>
                  </div>
                  <div className="min-h-[64px] flex flex-wrap gap-2">
                    {Object.entries(assign).filter(([w, bb]) => bb === b).map(([w]) => {
                      const isCorrect = (b === "Akk" && akkusativ.includes(w)) || (b === "Dat" && dativ.includes(w)) || (b === "Wechsel" && wechsel.includes(w));
                      return (
                        <span key={w} className={"px-2.5 py-1 rounded-lg text-sm border " + (isCorrect ? "border-green-400 bg-green-50" : "border-rose-300 bg-rose-50")}>{w}</span>
                      );
                    })}
                  </div>
                </div>
              ))}

              <div className="md:col-span-4 flex items-center gap-3 text-sm">
                <span className="text-slate-700">Richtig in dieser Übung: <b>{correct3}</b> / {total3}</span>
                {showSolutions && (
                  <span className="text-slate-500">Tipp: Nutze die graue Hinweiszeile über jedem Bereich.</span>
                )}
              </div>
            </div>
          </Card>
        </section>

        {/* Kurzgrammatik */}
        <section id="theorie" className="mt-10">
          <Card title={<span>Kurzgrammatik: Präpositionen auf A2</span>}>
            <div className="prose max-w-none prose-slate">
              <h4>Richtungen & Orte</h4>
              <ul>
                <li><b>nach</b> + Städte/Länder ohne Artikel: „Ich fahre <i>nach</i> Spanien.“</li>
                <li><b>in</b> + Akkusativ (Bewegung) / Dativ (Position): „Ich gehe <i>in</i> die Schule.“ vs. „Ich bin <i>in</i> der Schule.“</li>
                <li><b>zu</b> + Dativ für Personen/Institutionen: „Ich gehe <i>zum</i> Arzt / <i>zur</i> Bank.“</li>
                <li><b>aus</b> + Dativ (Herkunft): „Sie kommt <i>aus</i> Österreich.“</li>
                <li><b>von</b> + Dativ (Herkunft Punkt): „Er kommt <i>vom</i> Bahnhof.“</li>
              </ul>
              <h4>Zeit</h4>
              <ul>
                <li><b>seit</b> + Dativ: Beginn in der Vergangenheit – „Ich lerne <i>seit</i> 2 Jahren Deutsch.“</li>
                <li><b>vor</b> (+ Dativ/Dativergänzung): „<i>Vor</i> einem Jahr…“</li>
                <li><b>nach</b>: „<i>Nach</i> dem Essen…“</li>
                <li><b>in</b>: Zukunft – „<i>In</i> zwei Wochen…“</li>
              </ul>
              <h4>Fälle</h4>
              <ul>
                <li><b>Akkusativ-Präpositionen:</b> für, ohne, gegen, um, durch</li>
                <li><b>Dativ-Präpositionen:</b> mit, nach, bei, seit, von, zu, aus</li>
                <li><b>Wechselpräpositionen (Akk./Dat.):</b> an, auf, in, neben, über, unter, vor, hinter, zwischen</li>
              </ul>
            </div>
          </Card>
        </section>

        <Footer />
      </main>
    </div>
  );
}
