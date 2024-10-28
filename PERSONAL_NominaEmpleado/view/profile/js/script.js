// Fetch server time
async function fetchServerTime() {
  try {
    const response = await fetch("time.php");
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    console.log("Server time fetched:", data.time);
    return data.time;
  } catch (error) {
    console.error("Error fetching time:", error);
    return null;
  }
}

// Update local clock
function updateLocalClock() {
  const clockElem = document.getElementById("reloj");
  const timeParts = clockElem.textContent.split(":");
  let hours = parseInt(timeParts[0]);
  let minutes = parseInt(timeParts[1]);
  let seconds = parseInt(timeParts[2]);

  seconds++;
  if (seconds >= 60) {
    seconds = 0;
    minutes++;
  }
  if (minutes >= 60) {
    minutes = 0;
    hours++;
  }
  if (hours >= 24) {
    hours = 0;
  }

  clockElem.textContent =
    hours.toString().padStart(2, "0") +
    ":" +
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

// Initialize local clock
async function initializeLocalClock() {
  const serverTime = await fetchServerTime();
  if (serverTime) {
    const clockElem = document.getElementById("reloj");
    clockElem.textContent = serverTime;
    setInterval(updateLocalClock, 1000);
  } else {
    document.getElementById("reloj").textContent = "Error loading time";
  }
}

// Registrar asistencia
async function logAsistencia() {
  const tipoAccion = document.getElementById("tipoAccion").value;

  // Habilitar o deshabilitar el botón según el tipo de acción
  if (tipoAccion === "Entrada") {
    document.getElementById("tiempoInicio").disabled = false;
    document.getElementById("btn_asistenciaLog").disabled = true;
    document.getElementById("btn_asistenciaLog").style.backgroundColor = "grey";
  } else if (tipoAccion === "Salida") {
    tiempoPausaSalida();
    document.getElementById("tiempoInicio").disabled = true;
    document.getElementById("tiempoInicio").style.backgroundColor = "grey";
    document.getElementById("tiempoPausas").disabled = true;
    document.getElementById("tiempoPausas").style.backgroundColor = "grey";
    document.getElementById("btn_asistenciaLog").disabled = true;
    document.getElementById("btn_asistenciaLog").style.backgroundColor = "grey";
    document.getElementById("btn_justificacion").style.backgroundColor =
      "#1abc9c";
    document.getElementById("btn_justificacion").style.pointerEvents = "auto";
    document.getElementById("btn_justificacion").disabled = false;

    document.getElementById("justificacion_txt").disabled = false;

    document.getElementById("tiempoAlmuerzo").disabled = true;
    document.getElementById("tiempoAlmuerzo").style.backgroundColor = "grey";
    document.getElementById("tiempoResumen").disabled = true;
    document.getElementById("tiempoResumen").style.backgroundColor = "grey";
    document.getElementById("tiempoFinalizacion").style.backgroundColor =
      "#e74c3c";

    document.getElementById("tiempoFinalizacion").disabled = false;
  }

  const response = await fetch(`log_time.php?tipoAccion=${tipoAccion}`);
  if (!response.ok) {
    console.error("Error registrando la asistencia:", response.statusText);
    document.getElementById("tiempoInicio").disabled = false;
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById("asistenciaLog");

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);

  // Habilitar el botón después de registrar la asistencia, si es necesario
  if (tipoAccion !== "Salida") {
    document.getElementById("tiempoInicio").disabled = false;
  }
}

document.addEventListener("DOMContentLoaded", initializeLocalClock);

// Timer logic
let timerInterval;
let startTime;
let pausedTime = 0;
let paused = false;
const initialTime = 6 * 60 * 60 * 1000 + 40 * 60 * 1000;

function updateTimerClock() {
  const clockElem = document.getElementById("temporizador_trabajo");
  const timeParts = clockElem.textContent.split(":");
  let hours = parseInt(timeParts[0]);
  let minutes = parseInt(timeParts[1]);
  let seconds = parseInt(timeParts[2]);

  if (seconds === 0 && minutes === 0 && hours === 0) {
    clearInterval(timerInterval);
    temporizadorLog("Finalizado", clockElem.textContent, "Timer1");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }
  if (minutes < 0) {
    minutes = 59;
    hours--;
  }

  clockElem.textContent =
    hours.toString().padStart(2, "0") +
    ":" +
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeTimerClock() {
  const clockElem = document.getElementById("temporizador_trabajo");
  const [initialHours, initialMinutes, initialSeconds] = [
    Math.floor(initialTime / (60 * 60 * 1000)),
    Math.floor((initialTime % (60 * 60 * 1000)) / (60 * 1000)),
    Math.floor((initialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialHours.toString().padStart(2, "0") +
    ":" +
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function tiempoInicio() {
  clearInterval(timerInterval);
  startTime = new Date().getTime();
  timerInterval = setInterval(updateTimerClock, 1000);

  document.getElementById("tiempoInicio").disabled = true;
  document.getElementById("tiempoPausas").disabled = false;
  document.getElementById("tiempoAlmuerzo").disabled = false;

  document.getElementById("btn_asistenciaLog").disabled = false;

  document.getElementById("btn_asistenciaLog").style.backgroundColor =
    "#1abc9c";

  document.getElementById("tiempoInicio").style.backgroundColor = "grey";
  document.getElementById("tiempoResumen").style.backgroundColor = "grey";
  document.getElementById("tiempoFinalizacion").style.backgroundColor = "grey";
}

function tiempoPausas() {
  clearInterval(timerInterval);
  paused = true;
  pausedTime += new Date().getTime() - startTime;

  startSecondTimer();

  document.getElementById("tiempoResumen").disabled = false;
  document.getElementById("tiempoPausas").disabled = true;
  document.getElementById("tiempoFinalizacion").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = true;
  document.getElementById("btn_asistenciaLog").disabled = true;

  document.getElementById("btn_asistenciaLog").style.backgroundColor = "grey";
  document.getElementById("tiempoPausas").style.backgroundColor = "grey";
  document.getElementById("tiempoFinalizacion").style.backgroundColor = "grey";
  document.getElementById("tiempoAlmuerzo").style.backgroundColor = "grey";
  document.getElementById("tiempoResumen").style.backgroundColor = "#A474A4";

  const pausasElem = document.getElementById("pausas");
  const currentPauseCount = parseInt(pausasElem.textContent);
  pausasElem.textContent = currentPauseCount + 1;
}

function tiempoPausaSalida() {
  clearInterval(timerInterval);
  paused = true;
  pausedTime += new Date().getTime() - startTime;
}

function tiempoPausas2() {
  clearInterval(timerInterval);
  paused = true;
  pausedTime += new Date().getTime() - startTime;

  document.getElementById("tiempoResumen").disabled = false;
  document.getElementById("tiempoPausas").disabled = true;
  document.getElementById("tiempoFinalizacion").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = true;
  document.getElementById("btn_asistenciaLog").disabled = true;

  document.getElementById("btn_asistenciaLog").style.backgroundColor = "grey";
  document.getElementById("tiempoPausas").style.backgroundColor = "grey";
  document.getElementById("tiempoFinalizacion").style.backgroundColor = "grey";
  document.getElementById("tiempoAlmuerzo").style.backgroundColor = "grey";
  document.getElementById("tiempoResumen").style.backgroundColor = "#A474A4";

  const pausasElem = document.getElementById("pausas");
  const currentPauseCount = parseInt(pausasElem.textContent);
  pausasElem.textContent = currentPauseCount + 1;
}

function tiempoResumen() {
  paused = false;
  startTime = new Date().getTime() - pausedTime;
  timerInterval = setInterval(updateTimerClock, 1000);
  pauseSecondTimer();
  pauseLunchTimer();

  //document.getElementById("tiempoFinalizacion").disabled = false;
  document.getElementById("tiempoPausas").disabled = false;
  document.getElementById("tiempoResumen").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = false;
  document.getElementById("btn_asistenciaLog").disabled = false;

  document.getElementById("btn_asistenciaLog").style.backgroundColor =
    "#1abc9c";

  document.getElementById("tiempoPausas").style.backgroundColor = "#FFA726";

  document.getElementById("tiempoAlmuerzo").style.backgroundColor = "#FF8BA7";
  document.getElementById("tiempoResumen").style.backgroundColor = "grey";
}

function tiempoFinalizacion() {
  clearInterval(timerInterval);
  const clockElem = document.getElementById("temporizador_trabajo");
  const finalTime = clockElem.textContent;
  temporizadorLog("Horas de trabajo cumplidas", finalTime, "Timer1");
  clockElem.textContent = "06:40:00";
  stopSecondTimer();
  stopLunchTimer();

  document.getElementById("tiempoInicio").disabled = true;
  document.getElementById("tiempoResumen").disabled = true;
  document.getElementById("tiempoPausas").disabled = true;
  document.getElementById("tiempoFinalizacion").disabled = true;
  document.getElementById("tiempoAlmuerzo").disabled = true;
  document.getElementById("btn_descargar").disabled = false;
  document.getElementById("btn_descargar").style.backgroundColor = "#1abc9c";
  document.getElementById("btn_descargar").style.pointerEvents = "auto";

  document.getElementById("btn_justificacion").style.backgroundColor = "grey";
  document.getElementById("btn_justificacion").style.pointerEvents = "none";
  document.getElementById("btn_justificacion").disabled = true;
  document.getElementById("justificacion_txt").disabled = true;

  document.getElementById("tiempoInicio").style.backgroundColor = "#1abc9c";
  document.getElementById("tiempoResumen").style.backgroundColor = " #A474A4";
  document.getElementById("tiempoPausas").style.backgroundColor = "#FFA726";

  document.getElementById("tiempoAlmuerzo").style.backgroundColor = "#FF8BA7";

  const pausasElem = document.getElementById("pausas");
  const dailyPauses = pausasElem.textContent;
  pausasElem.textContent = "0";

  fetch(`log_time.php?tipoAccion=tiempoFinalizacion&dailyPauses=${dailyPauses}`)
    .then((response) => response.text())
    .then((loggedTime) => {
      const pauseLogElem = document.getElementById("pausasLog");
      const pauseEntry = document.createElement("div");
      pauseEntry.textContent = loggedTime;
      pauseLogElem.appendChild(pauseEntry);
    })
    .catch((error) => console.error("Error logging daily pauses:", error));
}

async function temporizadorLog(action, time, timerType) {
  const response = await fetch(
    `log_time.php?action=${action}&time=${time}&tipoAccion=${timerType}`
  );
  if (!response.ok) {
    console.error("Error logging timer:", response.statusText);
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById(
    timerType === "Timer1"
      ? "timerLog"
      : timerType === "Timer2"
      ? "recesoLog"
      : timerType === "LunchTimer" // Check for LunchTimer
      ? "almuerzoLog"
      : "pausasLog" // Fallback for other logs
  );

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);
}
document.getElementById("tiempoInicio").addEventListener("click", tiempoInicio);
document.getElementById("tiempoPausas").addEventListener("click", tiempoPausas);
document
  .getElementById("tiempoResumen")
  .addEventListener("click", tiempoResumen);
document
  .getElementById("tiempoFinalizacion")
  .addEventListener("click", tiempoFinalizacion);

document.addEventListener("DOMContentLoaded", initializeTimerClock);

// Second timer logic
let secondTimerInterval;
let secondStartTime;
let secondPausedTime = 0;
let secondPaused = false;
const secondInitialTime = 20 * 60 * 1000;

function updateSecondTimerClock() {
  const clockElem = document.getElementById("temporizador_receso");
  const timeParts = clockElem.textContent.split(":");
  let minutes = parseInt(timeParts[0]);
  let seconds = parseInt(timeParts[1]);

  if (seconds === 0 && minutes === 0) {
    clearInterval(secondTimerInterval);
    temporizadorLog("Finalizado", clockElem.textContent, "Timer2");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }

  clockElem.textContent =
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeSecondTimerClock() {
  const clockElem = document.getElementById("temporizador_receso");
  const [initialMinutes, initialSeconds] = [
    Math.floor(secondInitialTime / (60 * 1000)),
    Math.floor((secondInitialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function startSecondTimer() {
  clearInterval(secondTimerInterval);
  secondStartTime = new Date().getTime();
  secondTimerInterval = setInterval(updateSecondTimerClock, 1000);
}

function pauseSecondTimer() {
  clearInterval(secondTimerInterval);
  secondPaused = true;
  secondPausedTime += new Date().getTime() - secondStartTime;
}

function resumeSecondTimer() {
  secondPaused = false;
  secondStartTime = new Date().getTime() - secondPausedTime;
  secondTimerInterval = setInterval(updateSecondTimerClock, 1000);
}

function stopSecondTimer() {
  clearInterval(secondTimerInterval);
  const clockElem = document.getElementById("temporizador_receso");
  const finalTime = clockElem.textContent;
  temporizadorLog("Tiempo de receso cumplido", finalTime, "Timer2");
  clockElem.textContent = "20:00";
}

async function logSecondTimer(action, time) {
  const response = await fetch(
    `log_time.php?action=${action}&time=${time}&tipoAccion=Timer2`
  );
  if (!response.ok) {
    console.error("Error logging second timer:", response.statusText);
    return;
  }
  const loggedTime = await response.text();
  const logElem = document.getElementById("recesoLog");

  const timeEntry = document.createElement("div");
  timeEntry.textContent = loggedTime;
  logElem.appendChild(timeEntry);
}

document.addEventListener("DOMContentLoaded", initializeSecondTimerClock);

// Lunch timer logic
let lunchTimerInterval;
let lunchStartTime;
let lunchPausedTime = 0;
let lunchPaused = false;
const lunchInitialTime = 60 * 60 * 1000; // 60 minutes

function updateLunchTimerClock() {
  const clockElem = document.getElementById("temporizador_almuerzo");
  const timeParts = clockElem.textContent.split(":");
  let minutes = parseInt(timeParts[0]);
  let seconds = parseInt(timeParts[1]);

  if (seconds === 0 && minutes === 0) {
    clearInterval(lunchTimerInterval);
    temporizadorLog("Finalizado", clockElem.textContent, "LunchTimer");
    return;
  }

  seconds--;
  if (seconds < 0) {
    seconds = 59;
    minutes--;
  }

  clockElem.textContent =
    minutes.toString().padStart(2, "0") +
    ":" +
    seconds.toString().padStart(2, "0");
}

function initializeLunchTimerClock() {
  const clockElem = document.getElementById("temporizador_almuerzo");
  const [initialMinutes, initialSeconds] = [
    Math.floor(lunchInitialTime / (60 * 1000)),
    Math.floor((lunchInitialTime % (60 * 1000)) / 1000),
  ];

  clockElem.textContent =
    initialMinutes.toString().padStart(2, "0") +
    ":" +
    initialSeconds.toString().padStart(2, "0");
}

function startLunchTimer() {
  clearInterval(lunchTimerInterval);
  lunchStartTime = new Date().getTime();
  lunchTimerInterval = setInterval(updateLunchTimerClock, 1000);

  tiempoPausas2();
}

function pauseLunchTimer() {
  clearInterval(lunchTimerInterval);
  lunchPaused = true;
  lunchPausedTime += new Date().getTime() - lunchStartTime;
}

function resumeLunchTimer() {
  lunchPaused = false;
  lunchStartTime = new Date().getTime() - lunchPausedTime;
  lunchTimerInterval = setInterval(updateLunchTimerClock, 1000);

  tiempoResumen();
}

function stopLunchTimer() {
  clearInterval(lunchTimerInterval);
  const clockElem = document.getElementById("temporizador_almuerzo");
  const finalTime = clockElem.textContent;
  temporizadorLog("Finalizado", finalTime, "LunchTimer");
  clockElem.textContent = "60:00"; // Reset lunch timer to 60 minutes
}

function enviarJustificacion() {
  var justificacion = document.getElementById("justificacion_txt").value;

  var formData = new FormData();
  formData.append("justificacion", justificacion);
  formData.append("actualizarJustificacion", true);

  document.getElementById("btn_justificacion").style.backgroundColor = "grey";
  document.getElementById("btn_justificacion").style.pointerEvents = "none";
  document.getElementById("btn_justificacion").disabled = true;

  document.getElementById("justificacion_txt").disabled = true;

  fetch("log_time.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
    });
}

document
  .getElementById("tiempoAlmuerzo")
  .addEventListener("click", startLunchTimer);
document
  .getElementById("pauseLunchTimer")
  .addEventListener("click", pauseLunchTimer);
document
  .getElementById("resumeLunchTimer")
  .addEventListener("click", resumeLunchTimer);
document
  .getElementById("stopLunchTimer")
  .addEventListener("click", stopLunchTimer);

// Pausar temporizador de almuerzo al continuar el principal
document.getElementById("tiempoResumen").addEventListener("click", () => {
  tiempoResumen();
  pauseLunchTimer();
});

document.addEventListener("DOMContentLoaded", initializeLunchTimerClock);
