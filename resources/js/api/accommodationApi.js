import axios from 'axios';

// Get the accommodations 9 by 9 and by decreasing order
export const getLastNineAccommodations = async (page = 1) => {
  return await axios
    .get(`/accommodations/getLastNine?page=${page}`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get the last 3 accommodations
export const getLastThreeAccommodations = async () => {
  return await axios
    .get(`/accommodations/getLastThree`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get accommodations by types and by decreasing order for 5 differents types (Bulles, Yourtes, Péniches, Cabane and Random)
export const getAccommodationsByTypes = async () => {
  return await axios
    .get(`/accommodations/getByTypes`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get all the images for a specific accommodation
export const getAccommodationsImages = async (accommodationId) => {
  return await axios
    .get(`/accommodation-images/${accommodationId}`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get all the reservations for a specific accommodation
export const getAccommodationReservations = async (accommodationId) => {
  return await axios
    .get(`/accommodation-reservations/${accommodationId}`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}