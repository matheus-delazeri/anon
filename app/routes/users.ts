import {allUsers, getUser} from '../controllers/user';
import express from "express";

const router = express.Router();

router.get("/", allUsers);
router.get("/:id", getUser);

export default router;