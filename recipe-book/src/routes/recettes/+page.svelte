<script>

	import ListofRecipes from '../../components/ListofRecipes.svelte';
	import NavBar from '../../components/NavBar.svelte';
</script>

<div class="mainBody">
	<NavBar />
	<ListofRecipes />
</div>

<style>
	.mainBody {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}
</style>
