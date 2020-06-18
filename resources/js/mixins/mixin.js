import Vue from 'vue'
import moment from 'moment'

Vue.mixin({
	data()
	{
		let permisos = JSON.parse(localStorage.getItem('permisos'));
		let user 	 = JSON.parse(localStorage.getItem('user'));
		let name 	 = JSON.parse(localStorage.getItem('name'));
		return {
			permisos: permisos,
			user:user,
			name:name,
		}
	},
    methods: {
    	dateFormat() {
    		return 'dd-MM-yyyy'
    	},
    	convertDate(date) {
    		if(date !== '' && date !== null) {
	          return moment(date).format('YYYY-MM-DD'); 
	        }
	          
	        return "";
    	},
    	formatDate (date) {
	        if(date !== '' && date !== null) {
	          return moment(date).format('DD-MM-YYYY'); 
	        }
	          
	        return "";
	    },
	    formatMoney() {
	    	return {
	          decimal: '.',
	          thousands: ',',
	          prefix: '',
	          suffix: '',
	          precision: 2,
	          masked: false
	        }
	    },
	    formatNumberReplaceCommas(number) {
	    	if(number) {
	    		return number.replace(/,/g,"")
	    	}
	    },
    }
})