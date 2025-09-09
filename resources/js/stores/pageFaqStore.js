import { defineStore } from 'pinia'
import { ref } from 'vue';

export const usePageFaqStore = defineStore('pageFaqStore', {
  state: () => {
    return {
      faqData: {
        title: "Retrouvez ici toutes les réponses à vos questions pour accueillir vos voyageurs en toute sérénité",
        tabs: [
          {
            title: "Quels types de logements puis-je proposer ?",
            texts: [
              "Vous pouvez proposer les types de logements suivants : <br /><br />",
              "• <b>Cabane</b> : idéale pour une expérience nature, rustique et dépaysante.",
              "• <b>Yourte</b> : un hébergement authentique qui invite au voyage et à la découverte culturelle.",
              "• <b>Bulle</b> : parfaite pour une nuit romantique sous les étoiles.",
              "• <b>Igloo</b> : une expérience insolite et unique, surtout en hiver.",
              "• <b>Maison</b> : un cadre confortable et familial, adapté aux séjours plus classiques.",
              "• <b>Péniche</b> : pour un séjour atypique au fil de l'eau.",
              "• <b>Chalet</b> : chaleureux et convivial, parfait pour les séjours en montagne."
            ],
            isOpen: ref(false),
          },
          {
            title: "Comment fixer mon prix ?",
            texts: [
              "Pour bien fixer le prix de votre logement insolite, commencez par comparer avec les hébergements similaires dans votre secteur afin d’avoir une base réaliste. Calculez ensuite vos coûts (entretien, équipements, énergie) pour vous assurer que votre tarif reste rentable. Tenez compte des particularités de votre hébergement : plus il est original ou bien situé, plus sa valeur perçue augmente. Pensez aussi à adapter vos prix selon les saisons : par exemple, proposer un tarif plus attractif en semaine ou en basse saison, et un tarif plus élevé lors des périodes de forte demande. Enfin, ajustez progressivement en fonction des réservations et des retours de vos voyageurs."
            ],
            isOpen: ref(false),
          },
          {
            title: "Que se passe-t-il en cas d'annulation ?",
            texts: [
              "Les conditions d'annulation et de modification des réservations sont spécifiques à chaque habitation insolite et sont définies par le propriétaire. Ces conditions sont clairement indiquées sur la fiche descriptive de l'hébergement et dans le processus de réservation. Le client est tenu d'en prendre connaissance avant de valider sa commande.<br /><br />",
              "En cas d'annulation par le client, les frais d'annulation applicables seront déduits du remboursement éventuel, conformément aux conditions du propriétaire. En cas d'annulation par le propriétaire, le vendeur s'engage à proposer au client un hébergement de substitution de qualité équivalente ou supérieure, ou un remboursement intégral de la réservation."
            ],
            isOpen: ref(false),
          },
        ]
      }
    }
  },
})
