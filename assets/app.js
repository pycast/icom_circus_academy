/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

require('bootstrap');

// Animate on scroll

import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

// Full calendar js

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

window.onload = () => {
    let calendarElt = document.getElementById('calendar')
    let data = document.querySelector('.jsinfo')
    let CalendarData = data.dataset.calData
    let FullCalendarData = JSON.parse(CalendarData)

    let calendar = new Calendar(calendarElt, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
        initialView: 'dayGridMonth',
        firstDay: 1,
        locale: 'fr',
        
        timeZone: 'Europe/Paris',
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek'
        },
        events: FullCalendarData
      });

    calendar.render();
}