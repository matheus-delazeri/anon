import { getGroupById, getGroupByName, updateGroup, createGroup, deleteGroup } from "../controllers/group";
import express from "express";

const router = express.Router();

//Get
router.get("/id/:id", getGroupById);
router.get("/name/:name", getGroupByName);

//Post
router.post("/create/", createGroup);

//Put
router.put("/update/:id", updateGroup);

//Delete
router.delete("/delete/:id", deleteGroup)

export default router;