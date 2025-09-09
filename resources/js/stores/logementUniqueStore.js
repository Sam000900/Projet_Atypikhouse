import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useLogementUniqueStore = defineStore('logementUnique', {
  state: () => {
    return {
      faqData: {
        title: "Retrouvez ici les réponses à toutes vos questions pour préparer votre séjour en toute sérénité.",
        tabs: [
          {
            title: "Heures d'arrivée et de départ",
            texts: [],
            isOpen: ref(false),
          },
          {
            title: "Animaux domestiques",
            texts: [],
            isOpen: ref(false),
          },
          {
            title: "Politique d'annulation",
            texts: ["..."],
            isOpen: ref(false),
          },
          {
            title: "Règles du logement",
            texts: [],
            isOpen: ref(false),
          },
        ]
      }
    }
  },

  actions: {
    setFaqData(accommodationData) {
      const formatTime = (timeString) => timeString?.slice(0, 5);

      this.faqData.tabs[0].texts = [
        `Arrivée après ${formatTime(accommodationData.arrival_time)}`,
        `Départ avant ${formatTime(accommodationData.departure_time)}`,
        `Âge minimum pour la location: ${accommodationData.minimum_age} ans`
      ];

      this.faqData.tabs[1].texts = [
        accommodationData.pets_allowed
          ? "Les animaux domestiques sont autorisés dans ce logement."
          : "Les animaux domestiques ne sont pas autorisés dans ce logement."
      ];

      this.faqData.tabs[3].texts = accommodationData.additional_rules
        ? [accommodationData.additional_rules]
        : ["Aucune règle supplémentaire spécifiée."];
    }
  }
})
