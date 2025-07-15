import axios from 'axios';

// Get the experiences 10 by 10 and by decreasing order
export const getLastTenExperiences = async (page = 1) => {
  return await axios
    .get(`/experiences/getLastTen?page=${page}`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get experiences by types and by decreasing order for 3 differents types ("Séjours bien-êtres", "Aventures", and "Gastronomie locale")
export const getExperiencesByTypes = async () => {
  return await axios
    .get(`/experiences/getByTypes`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get one experience for each 3 types ("Séjours bien-êtres", "Aventures", and "Gastronomie locale")
export const getUniqueExperienceByTypes = async () => {
  return await axios
    .get(`/experiences/getUniqueByTypes`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}

// Get all the reservations for a specific accommodation
export const getExperienceReservations = async (experienceId) => {
  return await axios
    .get(`/experience-reservations/${experienceId}`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}