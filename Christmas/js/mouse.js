window.onload = () => {
    const h1 = document.querySelector("h1");
    const fly = document.querySelector(".fly");

    let x = 0;
    let y = 0;
    let targetX = 0;
    let targetY = 0;

    let speed = 0.03;

    window.addEventListener("mousemove", (event) => {

        x = event.pageX;
        y = event.pageY;

    });
    const loop = () => {

        targetX += (x - targetX) * speed;
        targetY += (y - targetY) * speed;


        fly.style.left = targetX + "px";
        fly.style.top = targetY + "px";

        window.requestAnimationFrame(loop);
    };
    loop();
};
