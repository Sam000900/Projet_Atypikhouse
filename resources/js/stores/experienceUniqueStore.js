import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useExperienceUniqueStore = defineStore('experienceUnique', {
  state: () => {
    return {
      faqData: {
        title: "Retrouvez ici les réponses à toutes vos questions pour préparer votre activité en toute sérénité.",
        tabs: [
          {
            title: "Durer de la prestation",
            texts: ["La durée du massage varie selon la prestation choisir."],
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
            title: "Information complémentaire",
            texts: [],
            isOpen: ref(false),
          },
        ]
      }
    }
  },

  actions: {
    setFaqData(experienceData) {
      this.faqData.tabs[1].texts = [
        experienceData.pets_allowed
          ? "Les animaux domestiques sont autorisés."
          : "Les animaux domestiques ne sont pas autorisés."
      ];

      this.faqData.tabs[3].texts = experienceData.additional_information
        ? [experienceData.additional_information]
        : ["Aucune information complémentaire spécifiée."];
    }
  }
})
