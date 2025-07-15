export function getReservationStatus(arrival, departure) {
  const today = new Date();
  const arrivalDate = new Date(arrival);
  const departureDate = new Date(departure);

  if (today < arrivalDate) { return 'Confirmée'; }
  else if (today >= arrivalDate && today <= departureDate) { return 'En cours'; }
  else { return 'Terminée'; }
}