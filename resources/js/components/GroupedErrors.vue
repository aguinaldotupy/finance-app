<template>
	<div v-if="errors.length" id="grouped-errors">
	    <div class="alert alert-danger alert-dismissible">
	        <h4>{{ title }}</h4>
	        <ul v-cloak>
	            <li v-for="(error) in errors">{{ error }}</li>
	        </ul>
	    </div>
	</div>
</template>

<script>
	export default {
		props: {
			errors: {
			    type: Array | String,
				required: true,
			},
			title: {
				type: String,
				required: false,
				default: 'Whoops!'
			}
		}
	};
</script>
