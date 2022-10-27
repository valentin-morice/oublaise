<template>
    <div class="hero py-16 bg-base-200">
        <div class="hero-content lg:px-32 flex-col lg:flex-row">
            <img
                class="max-w-xs md:max-w-sm rounded-lg shadow-2xl"
                src="/img/castle_old.jpg"
            />
            <div class="lg:ml-12 lg:text-left lg:mt-0 mt-4 text-center">
                <h1 class="text-3xl lg:text-5xl font-bold">L'Histoire d'Oublaise</h1>
                <p class="pt-6 md:px-32 lg:px-0">
                    Situé à moins de trois heures de Paris, le domaine d'Oublaise est un lieu chargé de mémoire.
                    Apprenez-en plus sur cette atypique propriété.
                </p>
            </div>
        </div>
    </div>
    <div class="pb-32 py-28 lg:px-10">
        <div
            class="grid grid-cols-1 lg:grid-cols-3 px-4 lg:px-20 items-center gap-x-16"
        >
            <div class="order-2 lg:order-1 md:px-24 lg:px-0 mb-24 lg:mb-0">
                <ion-icon
                    class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                    name="home-outline"
                ></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">
                    Les Origines
                </h2>
                <p class="pt-3">
                    Le château fut bâti par le Marquis de Préaux au XIXème siècle, sur les fondations d’un château plus
                    ancien. Pendant 10 ans, il sert de refuge pour un collège déplacé de la région parisienne pour
                    éviter les bombardements durant la Seconde Guerre mondiale.
                </p>
            </div>
            <div class="order-2 lg:order-1 md:px-24 lg:px-0 mb-24 lg:mb-0">
                <ion-icon
                    class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                    name="heart-outline"
                ></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">
                    Humanitarisme
                </h2>
                <p class="pt-3">
                    Le domaine d'Oublaise fut ensuite acquis par Jean-Francois Perrette, ancien commandant de l'armée
                    française. Il en fit un lieu destiné à réhabiliter les veterans de guerre et les personnes en
                    situations précaires. Il se sépara du château à l'âge de 80 ans.
                </p>
            </div>
            <div class="order-2 lg:order-1 md:px-24 lg:px-0">
                <ion-icon
                    class="mx-auto block text-gray-700 font-bold text-4xl bg-base-200 p-4 rounded-xl mb-16"
                    name="hammer-outline"
                ></ion-icon>
                <h2 class="text-xl uppercase font-bold text-gray-700">
                    À Nos Jours
                </h2>
                <p class="pt-3">
                    Le Mouvement Hare Krishna a pris possession du domaine en 1974, et le maintient jusqu'à ce jour. De
                    nombreux travaux ont été entamés pour sauvegarder ce lieu unique et multiculturel, qui est ouvert au
                    public tout au long de la semaine.
                </p>
            </div>
        </div>
    </div>
    <div class="bg-base-200 py-32 lg:px-16">
        <div
            class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4"
        >
            <div class="order-2 lg:order-1 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">
                    Architecture
                </h2>
                <p class="pt-3">
                    Le château est construit dans le style Néo-Renaissance, et possède une somptueuse marqueterie de
                    bois sur chacun de ses trois étages, des colonnes de marbre finement sculptés, et même sa propre
                    petite chapelle avec ses vitraux. Une visite à ne pas manquer !
                </p>
            </div>
            <img
                class="order-1 max-w-xs lg:order-2 md:max-w-sm mb-12 lg:mb-0 md:mb-24 lg:ml-auto lg:mr-0 mx-auto rounded-lg shadow-2xl"
                src="/img/cows.jpg"
            />
        </div>
    </div>
    <div class="py-32 lg:px-16">
        <div
            class="grid grid-rows-2 grid-rows-1 lg:grid-cols-2 px-4 lg:px-20 items-center gap-x-4"
        >
            <div class="order-2 md:px-24 lg:px-0">
                <h2 class="text-xl uppercase font-bold text-gray-700">
                    Domaine & Alentours
                </h2>
                <p class="pt-3">
                    Le domaine d'Oublaise se situe dans la campagne du Centre-Val de Loire, qui comporte un grand nombre
                    de sites historiques, tels que des villages médiévaux et des châteaux. La région fut très appréciée
                    par la noblesse et la royauté française, notamment au 15ème siècle.
                </p>
            </div>
            <img
                class="order-1 max-w-xs md:max-w-sm mb-12 lg:mb-0 mx-auto md:mb-24 lg:mr-auto lg:ml-0 rounded-lg shadow-2xl"
                src="/img/forest.jpg"
            />
        </div>
    </div>
</template>

<script>
import Base from "./Layout/Base";

export default {
    layout: Base,
};
</script>
