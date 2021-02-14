// (() => {
//
//     let input = document.getElementById("search");
//     let pressSearch = document.getElementById("pressSearch");
//     let evolution1 = document.getElementById("evolution1");
//     let evolution2 = document.getElementById("evolution2");
//     let evolution3 = document.getElementById("evolution3");
//
//     function allEvolutions(search) {
//         fetch(search)
//             .then(function (response) {
//                 return response.json();
//             })
//             .then(function (pokemon) {
//
//                 let image = pokemon.sprites.front_default;
//                 let name = pokemon.forms[0].name;
//
//                 document.getElementById("pokemon-img").innerHTML = "<img src='" + image + "' id='mainimg'>";
//                 document.getElementById("name").innerText = "Name: " + name;
//
//                 fetch(pokemon.species.url)
//                     .then(function (response) {
//                         return response.json();
//                     })
//                     .then(function (species) {
//                         fetch(species.evolution_chain.url)
//                             .then(function (response) {
//                                 return response.json();
//                             })
//                             .then(function (evolution) {
//
//                                 if (evolution.chain.evolves_to.length === 1) {
//                                     one = "" + evolution.chain.species.url.replace('-species', '') + "";
//                                     two = "" + evolution.chain.evolves_to[0].species.url.replace('-species', '') + "";
//                                     if (evolution.chain.evolves_to[0].evolves_to[0] !== undefined) {
//                                         three = "" + evolution.chain.evolves_to[0].evolves_to[0].species.url.replace('-species', '') + "";
//                                     }
//
//                                     fetch(one)
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (firstEvo) {
//                                             evolution1.innerHTML = "<img src='" + firstEvo.sprites.front_default + "' id='evimg1'>";
//                                         });
//
//                                     fetch(two)
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (secondEvo) {
//                                             evolution2.innerHTML = "<img src='" + secondEvo.sprites.front_default + "' id='evimg2'>";
//                                         });
//
//                                     fetch(three)
//                                         .then(function (response) {
//                                             return response.json();
//                                         })
//                                         .then(function (thirdEvo) {
//                                             if (evolution.chain.evolves_to[0].evolves_to[0] === undefined) {
//                                                 evolution3.innerHTML = "<img src='img/backS.png'" + "' id='evimg3'>";
//                                             } else {
//                                                 evolution3.innerHTML = "<img src='" + thirdEvo.sprites.front_default + "' id='evimg3'>";
//                                             }
//                                         });
//                                 }
//                             });
//                     });
//             });
//     }
//
//
//     document.getElementById("evolution1").addEventListener("click", function () {
//         allEvolutions(one);
//     });
//
//     document.getElementById("evolution2").addEventListener("click", function () {
//         allEvolutions(two);
//     });
//
//     document.getElementById("evolution3").addEventListener("click", function () {
//         allEvolutions(three);
//     });
//
//     pressSearch.addEventListener("click", function () {
//         let search = "https://pokeapi.co/api/v2/pokemon/" + input.value;
//         allEvolutions(search.toLowerCase());
//     });
//
//
//     allEvolutions("https://pokeapi.co/api/v2/pokemon/1");
//
//
// })();