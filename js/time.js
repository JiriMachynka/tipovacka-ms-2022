function currentTime() {
    const date = new Date();
    let currentDate = date.toLocaleTimeString() + " " + date.toLocaleDateString();
    document.getElementById("current-time").innerText = "Aktuální čas: " + currentDate;
}

function timeLeft() {
    const matches = document.querySelectorAll(".match");
    if (matches != null) {
        matches.forEach((m) => {
            const values = m.querySelectorAll("td");
            let delta = Date();
            values.forEach((v, i) => {
                if (i == 0) {
                    delta = new Date(Date.parse(v.className)).getTime();
                    let now = new Date().getTime();
                    let diff = delta - now;
                    if (diff >= 0) {
                        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        let mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        let day = days > 0 ? `Dny: ${days}` : "";
                        let hour = hours > 0 ? `Hodiny: ${hours}` : "";
                        let min = mins > 0 ? `Minuty: ${mins}` : "";
                        v.innerText = `${day} ${hour} ${min}`;
                    }
                }
            });
        });
    }
}

const displayCurrentTime = setInterval(currentTime, 1000);
const tL = setInterval(timeLeft, 1000);

currentTime();
timeLeft();