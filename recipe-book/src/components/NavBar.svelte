<div class="navBody">
	<a href="/"><h1>New Recipe</h1></a>
	<a href="/recettes"><h1>All Recipes</h1></a>
</div>

<style>
	
	h1 {
		font-size: 2rem;	
		color: var(--navbar-font-color);
		margin-right: auto;
		padding-left: 25px;
		padding-right: 25px;
	}
	
	.navBody a{
		text-decoration: none;
	}
	.navBody a:hover h1{
		color: var(--navbar-hover-font-color);
	}

	.navBody {
		display: inline-flex;
		justify-content: center;
		align-items: center;
        position: fixed;
        top: 0;
        left: 0;
		width: 100vw;
		height: 7%;
		z-index: 1;
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border-bottom: 1px solid rgba(255, 255, 255, 0.619);
	}

</style>
