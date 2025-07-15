import { defineStore } from 'pinia'
import { ref } from 'vue';

export const usePageFaqStore = defineStore('logementUnique', {
  state: () => {
    return {
      faqData: {
        title: "Retrouvez ici toutes les réponses à vos questions pour accueillir vos voyageurs en toute sérénité",
        tabs: [
          {
            title: "Quels types de logements puis-je proposer ?",
            texts: ["..."],
            isOpen: ref(false),
          },
          {
            title: "Comment fixer mon prix ?",
            texts: ["..."],
            isOpen: ref(false),
          },
          {
            title: "Que se passe-t-il en cas d'annulation ?",
            texts: ["..."],
            isOpen: ref(false),
          },
        ]
      }
    }
  },
})
