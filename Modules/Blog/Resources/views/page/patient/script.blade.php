<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Static data for the last period date, cycle length, and period length
    const lastPeriodDate = new Date('2024-08-01'); // Last period start date
    const cycleLength = 28; // Days between cycles
    const periodLengthDays = 3; // Duration of the period in days

    // Generate the calendar using the static data
    generateCalendar(lastPeriodDate, cycleLength, periodLengthDays);

    function generateCalendar(lastPeriodDate, cycleLength, periodLengthDays) {
        const calendar = document.getElementById('calendar');
        calendar.innerHTML = '';

        // Generate the calendar for 3 months
        for (let i = 0; i < 3; i++) {
            const monthStartDate = new Date(lastPeriodDate);
            monthStartDate.setMonth(monthStartDate.getMonth() + i);
            monthStartDate.setDate(1);

            const monthEndDate = new Date(monthStartDate);
            monthEndDate.setMonth(monthEndDate.getMonth() + 1);
            monthEndDate.setDate(0); // Last day of the current month

            const periodStartDate = new Date(lastPeriodDate);
            const periodEndDate = new Date(periodStartDate);
            periodEndDate.setDate(periodStartDate.getDate() + periodLengthDays - 1);

            calendar.appendChild(createMonthTable(monthStartDate, monthEndDate, periodStartDate, periodEndDate));

            // Update the last period date to the start of the next cycle
            lastPeriodDate.setDate(lastPeriodDate.getDate() + cycleLength);
        }
    }

    function createMonthTable(monthStartDate, monthEndDate, periodStartDate, periodEndDate) {
        const table = document.createElement('table');
        const monthName = monthStartDate.toLocaleString('default', { month: 'long', year: 'numeric' });

        let firstDay = new Date(monthStartDate.getFullYear(), monthStartDate.getMonth(), 1).getDay();
        let lastDate = new Date(monthStartDate.getFullYear(), monthStartDate.getMonth() + 1, 0).getDate();

        const header = `<tr><th colspan="7">${monthName}</th></tr>`;
        const daysOfWeek = '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

        let days = '<tr>';
        for (let i = 0; i < firstDay; i++) {
            days += '<td></td>';
        }

        for (let day = 1; day <= lastDate; day++) {
            const currentDate = new Date(monthStartDate.getFullYear(), monthStartDate.getMonth(), day);
            let className = '';

            // Adjust the period start and end dates for the current month
            const overlapStartDate = new Date(Math.max(periodStartDate, monthStartDate));
            const overlapEndDate = new Date(Math.min(periodEndDate, monthEndDate));

            // Highlight days within the period
            if (currentDate >= overlapStartDate && currentDate <= overlapEndDate) {
                className = 'period-day';
            }

            days += `<td class="${className}">${day}</td>`;

            if ((day + firstDay) % 7 === 0) {
                days += '</tr><tr>';
            }
        }

        days += '</tr>';
        table.innerHTML = header + daysOfWeek + days;

        return table;
    }
});
</script>
