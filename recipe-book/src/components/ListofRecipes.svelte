<script>
    import {onMount} from 'svelte'
    import { sendXHR } from '../utils/requester';

    /**
	 * @type {any[]}
	 */
    let recipes = [];

    let debug;
    let parsedData;

    onMount(async () => {
        try {
            debug = await sendXHR('/get-recipes');
            //console.log(debug); 
            parsedData = JSON.parse(debug);
          ;
            recipes = parsedData['data']// Afficher la réponse dans la console
        } catch (error) {
            console.error(error);  // Gérer les erreurs
        }
    });

</script>

{#each recipes as recipe}
    <h1> {recipe.name}</h1>
{/each}


<style>
    h1{
        color: black;
        height: 200px;
    }
</style>