<script>
	import { sendXHR } from '../../utils/requester';

	export let title = '';
    export let recipeTitle = '';

	// async function handleSubmit(){
	//     if(title.trim()){
	//         const data = {
	//             name : title
	//         }
	//         try {
	//             const response = await sendXHR('/create-recipe', data).then(() => {window.location.reload()});
	//             alert("New recipe available:" + data['name']);
	//         } catch (error) {
	//             console.error("Error:" + error);
	//             alert("Failed!");
	//         }
	//     }
	//     else{
	//         alert("Title cannot be empty");
	//     }
	// }
</script>

<div class="titleContainer">
	<h2>{title}</h2>
	<input name='recipe[title]' type="text" placeholder="Type the name of your recipe here" bind:value={recipeTitle}/>
</div>

<style>
    .titleContainer{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
	h2 {
		font-size: 2rem;
		font-family:
			system-ui,
			-apple-system,
			BlinkMacSystemFont,
			'Segoe UI',
			Roboto,
			Oxygen,
			Ubuntu,
			Cantarell,
			'Open Sans',
			'Helvetica Neue',
			sans-serif;
		color: black;
		width: 100%;
		height: 3rem;
	}

	input {
		width: 80%;
		height: 3rem;
		border-radius: 1rem;
		padding-left: 1rem;
	}
	/* 
    button {
        width: 40%;
        height: 3rem;
        background-color: #f2c44f;
        border: none;
        border-radius: 1rem;
        margin-top: 1rem;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
    }

    button:hover {
        background-color: #e1b045;
    } */
</style>
