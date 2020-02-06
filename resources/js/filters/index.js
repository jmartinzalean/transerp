import Vue from 'vue';
import moment from 'moment';

moment.locale('es-ES');

Vue.filter('formatDayMonth', function(value) {
    if (value) {
        return moment(String(value)).format('DD MMMM')
    }
});

Vue.filter('formatDay', function(value) {
    if (value) {
        return moment(String(value)).format('DD')
    }
});

Vue.filter('formatMonth', function(value) {
    if (value) {
        return moment(String(value)).format('MMMM')
    }
});

Vue.filter('formatHourMinute', function(value) {
    if (value) {
        return moment(String(value)).format('HH:mm')
    }
});

Vue.filter('formatDayMonthYear', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')
    }
});

Vue.filter('capitalize', function (value) {
    if (!value) {
        return ''
    }
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1)
});

Vue.filter('subString', function (value) {
    if(!value){
        return '';
    }else{
        return value.substr(0, 100) + ((value.length >= 100) ? '...' : '');
    }
});