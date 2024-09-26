  function drawSvgPath(selector: string, drawTime: number, delay: number) {
    const svg = document.querySelector(selector);
    if (!svg) {
      console.error("SVG not found for the given selector");
      return;
    }
    const circles = svg.querySelectorAll("circle");
    if (circles) {
      circles.forEach((circle) => {
        circle.style.opacity = "0";
      });
      const circles_length = circles.length;
      //show each circle with delay
      circles.forEach((circle, index) => {
        setTimeout(() => {
          circle.style.opacity = "1";
        }, (drawTime / circles_length) * 0.9 * index);
      });
    }
    const path = svg.querySelector("path");
    if (!path) {
      console.error("SVG path not found for the given selector");
      return;
    }

    const length = path.getTotalLength();
    console.log("length", length);

    // Hide the path initially
    path.style.strokeDasharray = length;
    path.style.strokeDashoffset = length;

    // Ensure the path is hidden before setting the transition
    setTimeout(() => {
      // Now apply the transition
      path.style.transition = `stroke-dashoffset ${drawTime}ms ease-in-out`;
      path.style.strokeDashoffset = "0"; // Start drawing the path
    }, delay); // Slight delay before setting transition
  }

  // Usage example:
  drawSvgPath("#icon-home-intro-left", 3000, 500); // 5 seconds to draw the path
