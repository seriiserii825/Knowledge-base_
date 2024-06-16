import gsap from 'gsap';

export default function teamAnimation() {
  const item_1 = document.querySelector('.team-animation__item:nth-of-type(1)');
  const item_2 = document.querySelector('.team-animation__item:nth-of-type(2)');
  const item_3 = document.querySelector('.team-animation__item:nth-of-type(3)');
  const item_4 = document.querySelector('.team-animation__item:nth-of-type(4)');
  const item_5 = document.querySelector('.team-animation__item:nth-of-type(5)');
  const item_6 = document.querySelector('.team-animation__item:nth-of-type(6)');
  const circle = document.querySelector('.team-animation__circle');

  const toggleSet = (set: boolean) => set ? 'set' : 'to';
  let tl = gsap.timeline();
  function showAll(set = false) {
    tl[toggleSet(set)](item_1, {duration: 1, x: "-760%"})
    tl[toggleSet(set)](item_2, {duration: 0.5, x: "-610%"}, "-=0.5")
    tl[toggleSet(set)](item_3, {duration: 0.4, x: "-460%"}, "-=0.3")
    tl[toggleSet(set)](item_4, {duration: 0.3, x: "-310%"}, "-=0.2")
    tl[toggleSet(set)](item_5, {duration: 0.2, x: "-160%"}, "-=0.1")
  }

  function moveLeft(set = false) {
    tl[toggleSet(set)](item_1, {duration: 1, x: "-770%", scale: 1.1})
    tl[toggleSet(set)](item_2, {duration: 1, x: "-620%", scale: 1.08}, "-=1")
    tl[toggleSet(set)](item_3, {duration: 1, x: "-470%", scale: 1.06}, "-=1")
    tl[toggleSet(set)](item_4, {duration: 1, x: "-320%", scale: 1.04}, "-=1")
    tl[toggleSet(set)](item_5, {duration: 1, x: "-170%"}, "-=1")
  }

  function moveRight(set = false) {
    tl[toggleSet(set)](item_1, {duration: 3, x: "-480%", scale: 1.6})
    tl[toggleSet(set)](item_2, {duration: 3, x: "-310%", scale: 0.9}, "-=3")
    tl[toggleSet(set)](item_3, {duration: 3, x: "-190%", scale: 0.75}, "-=3")
    tl[toggleSet(set)](item_4, {duration: 3, x: "-100%", scale: 0.5}, "-=3")
    tl[toggleSet(set)](item_5, {duration: 3, x: "-30%", scale: 0.3}, "-=3")
    tl[toggleSet(set)](item_6, {duration: 3, x: "20%", scale: 0.2}, "-=3")
  }

  function moveBitLeft(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-490%", scale: 1.7})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-320%", scale: 1}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-200%", scale: 0.85}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-110%", scale: 0.6}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-40%", scale: 0.4}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "30%", scale: 0.3}, "-=2")
  }
  function moveBitRight(set = false) {
    tl[toggleSet(set)](item_1, {duration: 1.5, x: "-480%", scale: 1.6})
    tl[toggleSet(set)](item_2, {duration: 1.5, x: "-310%", scale: 0.9}, "-=1.5")
    tl[toggleSet(set)](item_3, {duration: 1.5, x: "-190%", scale: 0.75}, "-=1.5")
    tl[toggleSet(set)](item_4, {duration: 1.5, x: "-100%", scale: 0.5}, "-=1.5")
    tl[toggleSet(set)](item_5, {duration: 1.5, x: "-30%", scale: 0.3}, "-=1.5")
    tl[toggleSet(set)](item_6, {duration: 1.5, x: "20%", scale: 0.2}, "-=1.5")
  }

  function moveLongLeft(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-770%", scale: 0.8})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-640%", scale: 1.2}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-480%", scale: 1.4}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-340%", scale: 0.8}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-220%", scale: 1}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "-80%", scale: 1.2}, "-=2")
  }

  function moveShortRight(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-760%", scale: 0.8})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-630%", scale: 1.2}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-470%", scale: 1.4}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-330%", scale: 0.8}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-210%", scale: 1}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "-70%", scale: 1.2}, "-=2")
  }

  function allSmall(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-760%", scale: 0.3})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-630%", scale: 0.5}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-470%", scale: 0.8}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-330%", scale: 0.2}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-210%", scale: 0.3}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "-70%", scale: 0.5}, "-=2")
  }
  function allScale(set = false) {
    tl[toggleSet(set)](item_1, {duration: 3, x: "-51%", scale: 6, opacity: 0.5})
    tl[toggleSet(set)](item_2, {duration: 3, x: "-100%", scale: 6, opacity: 0.2}, "-=3")
    tl[toggleSet(set)](item_3, {duration: 3, x: "-200%", scale: 6, opacity: 0.2}, "-=3")
    tl[toggleSet(set)](item_4, {duration: 3, x: "-500%", scale: 6, opacity: 0.2}, "-=3")
    tl[toggleSet(set)](item_5, {duration: 3, x: "-600%", scale: 6, opacity: 0.2}, "-=3")
    tl[toggleSet(set)](item_6, {duration: 3, x: "-692%", scale: 6, opacity: 0.5}, "-=3")
  }

  function allScaleSplit(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-72%", scale: 6, opacity: 0.5, ease: "power2.in"})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-140%", scale: 6, opacity: 0.2, ease: "power2.in"}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-240%", scale: 6, opacity: 0.2, ease: "power2.in"}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-450%", scale: 6, opacity: 0.2, ease: "power2.in"}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-550%", scale: 6, opacity: 0.2, ease: "power2.in"}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "-672%", scale: 6, opacity: 0.5, ease: "power2.in"}, "-=2")
  }
  function allScaleCircle(set = false) {
    tl[toggleSet(set)](item_1, {duration: 2, x: "-51%", scale: 6, opacity: 0.5, ease: "power2.out"})
    tl[toggleSet(set)](item_2, {duration: 2, x: "-100%", scale: 6, opacity: 0.2, ease: "power2.out"}, "-=2")
    tl[toggleSet(set)](item_3, {duration: 2, x: "-200%", scale: 6, opacity: 0.2, ease: "power2.out"}, "-=2")
    tl[toggleSet(set)](item_4, {duration: 2, x: "-500%", scale: 6, opacity: 0.2, ease: "power2.out"}, "-=2")
    tl[toggleSet(set)](item_5, {duration: 2, x: "-600%", scale: 6, opacity: 0.2, ease: "power2.out"}, "-=2")
    tl[toggleSet(set)](item_6, {duration: 2, x: "-692%", scale: 6, opacity: 0.5, ease: "power2.out"}, "-=2")
    tl[toggleSet(set)](circle, {duration: 2, scale: 1, opacity: 0.5, ease: "power2.out"}, "-=2")
  }
  function allMakeSmall(set = false) {
    const duration = 5
    const scale = 0.5
    tl[toggleSet(set)](item_1, {duration: duration, x: "-760%", y: "-54", scale: scale, opacity: 1})
    tl[toggleSet(set)](item_2, {duration: duration, x: "-558%", y: "84", scale: scale, opacity: 1}, `-=${duration}`)
    tl[toggleSet(set)](item_3, {duration: duration, x: "-438%", y: "-138", scale: scale, opacity: 1}, `-=${duration}`)
    tl[toggleSet(set)](item_4, {duration: duration, x: "-300%", y: "132", scale: scale, opacity: 1}, `-=${duration}`)
    tl[toggleSet(set)](item_5, {duration: duration, x: "-148%", y: "-63", scale: scale, opacity: 1}, `-=${duration}`)
    tl[toggleSet(set)](item_6, {duration: duration, x: "-0%", y: "50", scale: scale, opacity: 1}, `-=${duration}`)
    tl[toggleSet(set)](circle, {duration: 0.2, scale: 0}, `-=5`)
    tl[toggleSet(set)](circle, {duration: 5, scale: 30, opacity: 0, ease: "power2.out"}, `-=5`)
  }
  function allMakeBig(set = false) {
    const duration = 3
    const scale = 1
    tl[toggleSet(set)](item_1, {duration: duration, x: "-760%", scale: scale})
    tl[toggleSet(set)](item_2, {duration: duration, x: "-558%", scale: scale}, `-=${duration}`)
    tl[toggleSet(set)](item_3, {duration: duration, x: "-438%", scale: scale}, `-=${duration}`)
    tl[toggleSet(set)](item_4, {duration: duration, x: "-300%", scale: scale}, `-=${duration}`)
    tl[toggleSet(set)](item_5, {duration: duration, x: "-148%", scale: scale}, `-=${duration}`)
    tl[toggleSet(set)](item_6, {duration: duration, x: "-0%", scale: scale}, `-=${duration}`)
  }

  showAll();
  moveLeft();
  moveRight();
  moveBitLeft();
  moveBitRight();
  moveLongLeft();
  moveShortRight();
  allSmall();
  allScale();
  allScaleSplit();
  allScaleCircle();
  allMakeSmall();
  allMakeBig();

}
