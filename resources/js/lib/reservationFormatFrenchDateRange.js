export function reservationFormatFrenchDateRange(arrival, departure) {
  const options = { day: 'numeric', month: 'long', year: 'numeric' };
  const formatter = new Intl.DateTimeFormat('fr-FR', options);

  const arrivalDate = new Date(arrival);
  const departureDate = new Date(departure);

  return `Du ${formatter.format(arrivalDate)} au ${formatter.format(departureDate)}`;
}