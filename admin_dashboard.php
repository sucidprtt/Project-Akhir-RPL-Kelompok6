<!DOCTYPE html>
<html>
<head>
  <title>Laporan Admin PSPP</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      background-color: #f0f0f0;
    }

    .sidebar {
      width: 200px;
      background-color: #2c3e50;
      height: 100vh;
      padding-top: 20px;
      position: fixed;
    }

    .sidebar h2 {
      color: #fff;
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 20px 0;
      text-align: start;
      padding-left: 10px;
    }

    .sidebar ul li a {
      color: #fff;
      text-decoration: none;
      font-size: 18px;
    }

    .content {
      margin-left: 200px;
      width: calc(100% - 200px);
    }

    .header {
      background-color: #ecf0f1;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header .title {
      font-size: 24px;
      color: #34495e;
    }

    .header .profile {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .header .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-left: 10px;
    }

    .header .welcome {
      font-size: 16px;
      color: #34495e;
      margin-right: 10px;
    }

    .main-content {
      padding: 20px;
    }

    .clock-card {
      background-color: #2c3e50;
      padding: 20px;
      border-radius: 100px;
      text-align: center;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .clock-card .clock {
      font-size: 48px;
    }

    .clock-card .date {
      font-size: 20px;
      color: #fff;
    }

    .calendar {
      background-color: #2c3e50;
      color: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-top: 5px;
    }

    .calendar table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .calendar th, .calendar td {
      padding: 10px;
    }

    .calendar th {
      color: #fff;
    }

    .calendar .today {
      background-color: #0067d8;
      border-radius: 50%;
      color: #fff;
      padding: 10px;
    }
  </style>
  <script>
    function updateClock() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');
      const day = now.toLocaleString('en-us', { weekday: 'long' });
      const date = now.toLocaleString('en-us', { year: 'numeric', month: 'long', day: 'numeric' });

      document.querySelector('.clock').textContent = `${hours}:${minutes}:${seconds}`;
      document.querySelector('.date').textContent = `${day}, ${date}`;
    }

    function refreshAt(hours, minutes, seconds) {
      const now = new Date();
      const then = new Date();

      if (now.getHours() > hours ||
          (now.getHours() === hours && now.getMinutes() > minutes) ||
          (now.getHours() === hours && now.getMinutes() === minutes && now.getSeconds() >= seconds)) {
        then.setDate(now.getDate() + 1);
      }
      then.setHours(hours);
      then.setMinutes(minutes);
      then.setSeconds(seconds);

      const timeout = (then.getTime() - now.getTime());
      setTimeout(() => {
        generateCalendar();
        refreshAt(hours, minutes, seconds);
      }, timeout);
    }

    function generateCalendar(month, year) {
      const now = new Date();
      month = month !== undefined ? month : now.getMonth();
      year = year || now.getFullYear();

      const daysInMonth = new Date(year, month + 1, 0).getDate();
      const firstDay = new Date(year, month, 1).getDay();

      let calendarHtml = '<table>';
      calendarHtml += '<tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr>';
      calendarHtml += '<tr>';

      for (let i = 0; i < firstDay; i++) {
        calendarHtml += '<td></td>';
      }

      for (let day = 1; day <= daysInMonth; day++) {
        if ((firstDay + day - 1) % 7 === 0 && day !== 1) {
          calendarHtml += '</tr><tr>';
        }
        const todayClass = (day === now.getDate() && month === now.getMonth() && year === now.getFullYear()) ? 'today' : '';
        calendarHtml += `<td class="${todayClass}">${day}</td>`;
      }

      // Isi sisa sel untuk melengkapi baris terakhir
      const lastDay = (firstDay + daysInMonth - 1) % 7;
      for (let i = lastDay + 1; i < 7; i++) {
        calendarHtml += '<td></td>';
      }

      calendarHtml += '</tr></table>';
      document.querySelector('.calendar-content').innerHTML = calendarHtml;
    }

    window.onload = function() {
      updateClock();
      generateCalendar();
      refreshAt(0, 0, 0); // Set to update at midnight
      setInterval(updateClock, 1000);
    };
  </script>
</head>
<body>
  <div class="sidebar">
    <h2>PPSP</h2>
    <ul>
      <li><a href="admin_dashboard.php">Home</a></li>
      <li><a href="penambahan_sparepart.php">Penambahan Sparepart</a></li>
      <li><a href="pendapatan_harian.php">Pendapatan Harian</a></li>
      <li><a href="pengaturan_akun_admin.php">Pengaturan Akun</a></li>
    </ul>
  </div>
  <div class="content">
    <div class="header">
      <div class="welcome">Home</div>
      <div class="profile" onclick="window.location.href='pengaturan_akun_admin.php'">
        <span>Hi Admin!</span>
        <img src="https://ui-avatars.com/api/?name=Admin&background=2c3e50&color=fff" alt="Profile Image">
      </div>
    </div>
    <div class="main-content">
      <h1>Selamat datang, Admin!</h1>
      <div class="clock-card">
        <div class="clock" id="clock"></div>
        <div class="date" id="date"></div>
      </div>
      <div class="calendar">
        <div class="calendar-content"></div>
      </div>
    </div>
  </div>
</body>
</html>
