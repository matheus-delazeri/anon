import { getGroupById, getGroupByName, updateGroup, createGroup, deleteGroup } from "../controllers/group";
import express from "express";

const router = express.Router();

//Get
router.get("/id/:id", getGroupById);
router.get("/name/:name", getGroupByName);

//Post
router.post("/", createGroup);

//Put
router.put("/", updateGroup);

//Delete
router.delete("/", deleteGroup)

export default router;