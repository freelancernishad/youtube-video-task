<template>
    <div>
        <slot></slot>
    </div>
</template>
<script>
export default {
     props: ['user'],
    created() {


		if (User.loggedIn()) {
            var localRole = localStorage.getItem('role');
            console.log(localRole);
            if (localRole == 'admin') {
                window.location.href = '/dashboard/adddmin'
            } else {
                window.location.href = '/dashboard/user'
            }
			// window.location.href = '/dashboard'
		}




    },

    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>
