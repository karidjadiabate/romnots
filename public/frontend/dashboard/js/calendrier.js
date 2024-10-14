const calendar = document.querySelector('.calendar');
const monthYear = document.querySelector('.month-year');
const prevMonthButton = document.getElementById('prevMonth');
const nextMonthButton = document.getElementById('nextMonth');
const calendarGrid = document.querySelector('.calendar-grid');

let currentDate = new Date();

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDayOfMonth = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0);
    const lastDayOfPreviousMonth = new Date(year, month, 0);

    monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

    const days = [];

    for (let i = firstDayOfMonth.getDay() - 1; i > 0; i--) {
        days.push(lastDayOfPreviousMonth.getDate() - i + 1);
    }

    for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
        days.push(i);
    }

    while (days.length % 7 !== 0) {
        days.push(days.length % 7 + 1);
    }

    calendarGrid.innerHTML = `
<div class="day-name">Lu</div>
<div class="day-name">Ma</div>
<div class="day-name">Me</div>
<div class="day-name">Je</div>
<div class="day-name">Ve</div>
<div class="day-name">Sa</div>
<div class="day-name">Di</div>
`;

    days.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = day;

        if (day === date.getDate() && date.getMonth() === currentDate.getMonth() && date.getFullYear() === currentDate.getFullYear()) {
            dayElement.classList.add('current-day');
        }

        calendarGrid.appendChild(dayElement);
    });
}

prevMonthButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextMonthButton.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

renderCalendar(currentDate);